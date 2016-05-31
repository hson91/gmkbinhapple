<?php

class NewsController extends AController
{
	/**
	 *
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */


	/**
	 *
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array( 'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array( 'delete', 'index', 'create', 'update', 'deletes', 'enableHome', 'ordering', 'status', 'batch', 'fixThumbs' ),
				'roles'=>array( 'admin' ),
			),
			array( 'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array( 'index', 'update' ),
				'roles'=>array( 'manager' ),
			),
			array( 'deny',  // deny all users
				'users'=>array( '*' ),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$targetPath = Yii::app()->basePath.'/../static/images/news/';
		$this->breadcrumbs = array( 'News Manager'=>array( 'news/index' ), 'Create'=>array( 'news/create' ) );
		$model = new News;

		if (isset($_POST['News'])){
			$model->attributes=$_POST['News'];
			$image = CUploadedFile::getInstance($model,'image');
			$imageName = $model->alias;
            if ($image != null) {
                $model->image = $imageName.'.'.$image->extensionName;
                if($image->saveAs($targetPath.$model->image)){
                    $imgthumb = Yii::app()->phpThumb->create($targetPath.$model->image);
                    $imgthumb->resize(160,120);
                    $imgthumb->save($targetPath.'thumbs/'.$model->image);
                }
            }
			if ($model->save()){
				$this->redirect( array( 'index' ) );
			}else{
				@unlink($targetPath.$imageName);
				@unlink($targetPath.'thumbs/'.$imageName);
			}
		}

		$this->render( 'create', array(
				'model'=>$model,
			) );
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate( $id, $goto = null ) {
		$targetPath = Yii::app()->basePath.'/../static/images/news/';
		$this->breadcrumbs = array( 'News Manager'=>array( 'news/index' ), 'Update News '.$id=>array( 'news/update', 'id'=>$id ) );
		$model=$this->loadModel( $id );
		$oldImage = $model->image;
		if ( isset( $_POST['News'] ) ) {
			$model->attributes=$_POST['News'];
			$imageName = $model->alias;
            $image = CUploadedFile::getInstance($model,'image');
            if ($image != NULL) {
                $model->image = $imageName.'.'.$image->extensionName;
                if($image->saveAs($targetPath.$model->image)){
                    $imgthumb = Yii::app()->phpThumb->create($targetPath.$model->image);
                    $imgthumb->resize(160,120);
                    $imgthumb->save($targetPath.'thumbs/'.$model->image);
                }
            }else{
            	$model->image = $oldImage;
            }
			if ( $model->save() ) {
				$this->redirect( array( 'index') );
			}
		}

		$this->render( 'update', array(
				'model'=>$model,
			) );
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete( $id ) {
		$model = $this->loadModel( $id );
		if ( $model != null ) {
			$model->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if ( !isset( $_GET['ajax'] ) )
			$this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'admin' ) );
	}

	public function actionDeletes() {
		if ( isset( $_POST['ids'] ) ) {
			foreach ( $_POST['ids'] as $id ) {
				$model = $this->loadModel( $id );
				if ( $model != null ) {
					$model->delete();
				}
			}
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if ( !isset( $_GET['ajax'] ) )
			$this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'index' ) );
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {

		$this->breadcrumbs = array( 'News Manager'=>array( 'news/index' ) );
		$model=new News( 'search' );
		$model->unsetAttributes();  // clear any default values
		if ( isset( $_GET['News'] ) )
			$model->attributes=$_GET['News'];

		$this->render( 'index', array(
				'model'=>$model,
			) );
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel( $id ) {
		$model=News::model()->findByPk( $id );
		if ( $model===null )
			throw new CHttpException( 404, 'The requested page does not exist.' );
		return $model;
	}

	public function actionStatus( $id ) {
		$model = $this->loadModel( $id );
		if ( $model != null ) {
			$status = $model->status==1?0:1;
			$model->status = $status;
			$model->save();
			echo json_encode( array( 'status'=>$status ) );
			exit;
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if ( !isset( $_GET['ajax'] ) )
			$this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'index' ) );
	}
}

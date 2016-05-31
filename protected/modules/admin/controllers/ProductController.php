<?php

class ProductController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('UpdateThumb','delete','index','create','update','deletes','ordering','status','hot','new'),
				'roles'=>array('admin'),
			),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','update'),
				'roles'=>array('manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $targetPath = Yii::app()->basePath.'/../static/images/products/';
        $this->breadcrumbs = array('Danh Sách Sản Phẩm'=>array('product/index'),'Tạo Mới'=>array('product/create'));
		$model=new Product;
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
            
			if($model->save()) {
                $imageName = $model->alias;
                $image = CUploadedFile::getInstance($model,'image');
                if ($image != null) {
                    $model->image = $imageName.'.'.$image->extensionName;
                    if($image->saveAs($targetPath.$model->image)){
                        $imgthumb = Yii::app()->phpThumb->create($targetPath.$model->image);
                        $imgthumb->resize(300,200);
                        $imgthumb->save($targetPath.'thumbs/'.$model->image);
                        $model->save();
                    }
                }
                $this->redirect(array('update','id'=>$model->id));
			}
		}      
        
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $goto = null)
	{
        $targetPath = Yii::app()->basePath.'/../static/images/products/';
        $this->breadcrumbs = array('Danh Sách Sản Phẩm'=>array('product/index'),'Cập Nhật Sản Phẩm '.$id=>array('product/update', 'id'=>$id));
		$model=$this->loadModel($id);
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save()) {
                $imageName = $model->alias;
                $image = CUploadedFile::getInstance($model,'image');
                if ($image != null) {
                    $model->image = $imageName.'.'.$image->extensionName;
                    if($image->saveAs($targetPath.$model->image)){
                        $imgthumb = Yii::app()->phpThumb->create($targetPath.$model->image);
                        $imgthumb->resize(300,200);
                        $imgthumb->save($targetPath.'thumbs/'.$model->image);
                        $model->save();
                    }
                }
                $this->redirect(array('update', 'id'=>$model->id, 'goto'=>'end'));    
			}
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
        if ($model != null) {
            $targetPath = Yii::app()->basePath.'/../statc/images/products';
            if ($model->image != null && file_exists($targetPath.'/'.$model->image)) {
                @unlink($targetPath.'/'.$model->image);
                @unlink($targetPath.'/thumbs/'.$model->image);
            }
        }
        $model->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

    public function actionDeletes()
	{
        if (isset($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
            {
                $model = $this->loadModel($id);
                if ($model != null) {
                    $model->delete();    
                }
            }
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->breadcrumbs = array('Product Manager'=>array('product/index'));
        $model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
    public function actionOrdering()
    {
        $ordering = Yii::app()->request->getParam('ordering');
        $id = Yii::app()->request->getParam('id');
        $model = $this->loadModel($id);
        if ($model != null) {
            $model->ordering = $ordering;
            $model->save(false);
        }
    }
    
    public function actionStatus($id)
	{
        $model = $this->loadModel($id);
        if ($model != null) {
            $status = $model->status==1?0:1;
            $model->status = $status;
            $model->save();   
            echo json_encode(array('status'=>$status));
            exit;
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
    
    public function actionNew($id)
	{
        $model = $this->loadModel($id);
        if ($model != null) {
            $status = $model->is_new==1?0:1;
            $model->is_new = $status;
            $model->save();   
            echo json_encode(array('status'=>$status));
            exit;
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
    
    public function actionHot($id)
	{
        $model = $this->loadModel($id);
        if ($model != null) {
            $status = $model->is_hot==1?0:1;
            $model->is_hot = $status;
            $model->save();   
            echo json_encode(array('status'=>$status));
            exit;
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
}

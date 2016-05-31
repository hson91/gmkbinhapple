<?php

class ConfigController extends AController
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
				'actions'=>array('admin','delete','index','view','create','update'),
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->breadcrumbs = array('Danh Sách Cấu Hình'=>array('config/index'),'Tạo Mới'=>array('config/create'));
		$model=new Config;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
			if($model->save()) {
                $fileImage = CUploadedFile::getInstance($model,'image');
                if ($fileImage != null) {
                    $targetPath = Yii::app()->basePath.'/../data/images/config';
                    $image = new ImageLib;
                    $image->load($fileImage->tempName);
                    $image->save($targetPath.'/'.$model->var.'.'.$fileImage->extensionName);
                    $model->image = $model->var.'.'.$fileImage->extensionName;
                    $model->save();    
                }
                $this->redirect(array('index'));
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
	public function actionUpdate($id)
	{
        $this->breadcrumbs = array('Danh Sách Cấu Hình'=>array('config/index'),'Cập Nhật Cấu Hình '.$id=>array('config/update', 'id'=>$id));
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $old_image = $model->image;
		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
			if($model->save()) {
                $fileImage = CUploadedFile::getInstance($model,'image');
                if ($fileImage != null) {
                    $targetPath = Yii::app()->basePath.'/../data/images/config';
                    $image = new ImageLib;
                    $image->load($fileImage->tempName);
                    $image->save($targetPath.'/'.$model->var.'.'.$fileImage->extensionName);
                    $model->image = $model->var.'.'.$fileImage->extensionName;
                } else {
                    $model->image = $old_image;
                }
                if ($model->save()) {
                    $this->redirect(array('index'));    
                }
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
            $targetPath = Yii::app()->basePath.'/../data/images/config';
            if ($model->image != null && file_exists($targetPath.'/'.$model->image)) {
                    
            }
            $model->delete();    
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->breadcrumbs = array('Danh Sách Cấu Hình'=>array('config/index'));
        $model=new Config('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Config']))
			$model->attributes=$_GET['Config'];

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
		$model=Config::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

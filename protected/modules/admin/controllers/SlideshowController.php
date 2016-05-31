<?php

class SlideshowController extends AController
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
				'actions'=>array('admin','delete','index','view','create','update','deletes','newTab','status','ordering','linkGenerate','batch'),
				'roles'=>array('admin','poster'),
			),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','update'),
				'roles'=>array('manager'),
			),
			array('deny',  // deny all user
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
        $this->breadcrumbs = array('Danh Sách Slideshow'=>array('slideshow/index'),'Tạo Mới'=>array('slideshow/create'));
        $targetPath = Yii::app()->basePath.'/../data/images/slideshow';
		$model=new Slideshow;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slideshow']))
		{
            unset($_POST['Slideshow']['image']);
			$model->attributes=$_POST['Slideshow'];
			if($model->save()) {
			     $fileImage = CUploadedFile::getInstance($model, 'image');
                 if ($fileImage != null) {
                    $imageName = Helpers::toAlias($model->title);
                    while (file_exists($targetPath.'/'.$imageName.'.'.$fileImage->extensionName)) {
                        $imageName .= '_'.substr(md5(date('dmYHis')),0,2);   
                    }
                    $fileImage->saveAs($targetPath.'/'.$imageName.'.'.$fileImage->extensionName);
                    $model->image = $imageName.'.'.$fileImage->extensionName;
                    $model->save(false);
                    $this->generateImage($model->image);
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
        $this->breadcrumbs = array('Danh Sách Slideshow'=>array('slideshow/index'),'Cập Nhật Slideshow '.$id=>array('slideshow/update', 'id'=>$id));
        $targetPath = Yii::app()->basePath.'/../data/images/slideshow';
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slideshow']))
		{
			unset($_POST['Slideshow']['image']);
			$model->attributes=$_POST['Slideshow'];
			if($model->save()) {
                $fileImage = CUploadedFile::getInstance($model, 'image');
                if ($fileImage != null) {
                    $imageName = Helpers::toAlias($model->title);
                    while (file_exists($targetPath.'/'.$imageName.'.'.$fileImage->extensionName)) {
                        $imageName .= '_'.substr(md5(date('dmYHis')),0,2);   
                    }
                    $fileImage->saveAs($targetPath.'/'.$imageName.'.'.$fileImage->extensionName);
                    $model->image = $imageName.'.'.$fileImage->extensionName;
                    $model->save(false);
                    $this->generateImage($model->image);
                }
                $this->redirect(array('index'));
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
            $model->delete();    
        }

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
        $this->breadcrumbs = array('Danh Sách Slideshow'=>array('slideshow/index'));
        $model=new Slideshow('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slideshow']))
			$model->attributes=$_GET['Slideshow'];

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
		$model=Slideshow::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
    public function actionOrdering(){
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
    
    public function actionNewTab($id)
	{
        $model = $this->loadModel($id);
        if ($model != null) {
            $status = $model->new_tab==1?0:1;
            $model->new_tab = $status;
            $model->save();   
            echo json_encode(array('status'=>$status));
            exit; 
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
    
    /**
        var Type
        1: Bài Viết
        2: Trang Tĩnh
        3: Danh Mục
    */
    public function actionLinkGenerate(){
        $type = Yii::app()->request->getParam('type');
        $id = Yii::app()->request->getParam('id');
        switch ($type) {
            case 1: 
                $model = Post::model()->findByPk($id);
                echo Yii::app()->createAbsoluteUrl('post/detail',array('alias'=>$model->alias)); 
            break;
            case 2: 
                $model = Page::model()->findByPk($id);
                echo Yii::app()->createAbsoluteUrl('page/detail',array('alias'=>$model->alias));
            break;
            case 3: 
                $model = Category::model()->findByPk($id);
                echo Yii::app()->createAbsoluteUrl('post/index',array('alias'=>$model->alias));
            break;    
        }
        Yii::app()->end();
    }
    
    public function actionBatch(){
        $this->generateImage();
    }
    
    public function generateImage($fileName = true){
        set_time_limit(0);
        $targetPath = Yii::app()->basePath.'/../data/images/slideshow';
        $thumbs = Yii::app()->params['slideshow.thumbs'];
        if ($fileName === true) {
            $models = Slideshow::model()->findAll();
            foreach ($models as $model) {
                if ($model->image != '') {
                    if (file_exists($targetPath.'/'.$model->image)) {
                        $rootImage = new ImageLib;
                        $rootImage->load($targetPath.'/'.$model->image);
                        foreach ($thumbs as $thumb) {
                            $thumb_ar = explode('x',$thumb);
                            if (count($thumb_ar) == 2) {
                                $rootImage->getSliceImage($thumb_ar[0], $thumb_ar[1], $targetPath.'/thumbs/'.$thumb.'_'.$model->image);    
                            }
                        }
                    }
                }
            }
        } else {
            if (file_exists($targetPath.'/'.$fileName)) {
                $rootImage = new ImageLib;
                $rootImage->load($targetPath.'/'.$fileName);
                foreach ($thumbs as $thumb) {
                    $thumb_ar = explode('x',$thumb);
                    if (count($thumb_ar) == 2) {
                        $rootImage->getSliceImage($thumb_ar[0], $thumb_ar[1], $targetPath.'/thumbs/'.$thumb.'_'.$fileName);    
                    }
                }
            }
        }
    }
}

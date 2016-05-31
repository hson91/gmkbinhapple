<?php

class SiteController extends AController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
            'upload'=>'application.modules.admin.controllers.upload.UploadFileAction',
		);
	}
    
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}
    
    public function accessRules()
	{
		return array(
            array('allow',
                'actions'=>array('login'),
                'users'=>array('*'),
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','logout','error','profiles','upload','createRoles','siteMap'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        /*
        Yii::import('cext.yiimail.YiiMailMessage');
        $message = new YiiMailMessage;
        $message->setBody('text mail admin');
        $message->subject = 'text mail admin';
        $message->addTo(Yii::app()->params['adminEmail']);
        $message->from = Yii::app()->params['adminEmail'];
        Yii::app()->mail->send($message);
        */
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
	}
    
   	public function actionTable()
	{
        /*
        Yii::import('cext.yiimail.YiiMailMessage');
        $message = new YiiMailMessage;
        $message->setBody('text mail admin');
        $message->subject = 'text mail admin';
        $message->addTo(Yii::app()->params['adminEmail']);
        $message->from = Yii::app()->params['adminEmail'];
        Yii::app()->mail->send($message);
        */
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        $this->render('table');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout = 'login';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
			     if (Yii::app()->user->role=='user') {
			         $this->redirect(Yii::app()->homeUrl.'school');    
                     Yii::app()->end();
			     } 
			     $this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
    
    /**
	 * Displays the login page
	 */
	public function actionProfiles()
	{
        $this->layout = 'login';
		$model=Users::model()->findByPk(Yii::app()->user->id);
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='profiles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['update']))
		{
			$model->attributes=$_POST['Users'];
			// validate user input and redirect to the previous page if valid
			if($model->save()) {
                Yii::app()->user->setFlash('profiles','Cập Nhật Thông Tin Thành Công.');
                $this->refresh();
			}
		}
        
        if (isset($_POST['change'])) {
            $validate = true;
            $flash = '';
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            
            if ($old_password == ''){
                $flash .= 'Xin Hãy Nhập Mật Khẩu Cũ.<br />';
                $validate = false;
            }
            
            if ($new_password == '') {
                $flash .= 'Xin Hãy Nhập Mật Khẩu Mới.<br />';
                $validate = false;
            }
            
            if ($confirm_password == '') {
                $flash .= 'Xin Hãy Nhập Mật Khẩu Xác Nhận.<br />';
                $validate = false;
            }
            
            if ($old_password != '' && $new_password != '' && $confirm_password != '') {
                if ($model->password!==md5($old_password)) {
                    $flash .= 'Mật Khẩu Không Đúng.<br />';
                    $validate = false;
                } else {
                    if ($new_password!==$confirm_password) {
                        $flash .= 'Mật Khẩu Xác Nhận Không Đúng.<br />';
                        $validate = false;
                    }    
                }
            }
            
            if ($validate) {
                if ($old_password!=$new_password) {
                    $model->password=md5($_POST['new_password']);
        			if($model->save()) {
                        Yii::app()->user->setFlash('change','Đỗi Mật Khẫu Thành Công.');
                        $this->refresh();
        			}        
                }
            } else {
                Yii::app()->user->setFlash('error',$flash);
            }
        }
		// display the login form
		$this->render('profiles',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        $roleAssigned = Yii::app()->authManager->getRoles(Yii::app()->user->id);
 
        if (!empty($roleAssigned)) { //checks that there are assigned roles
            $auth = Yii::app()->authManager; //initializes the authManager
            foreach ($roleAssigned as $n => $role) {
                if ($auth->revoke($n, Yii::app()->user->id)) //remove each assigned role for this user
                Yii::app()->authManager->save(); //again always save the result
            }
        }
     
        Yii::app()->user->logout();
        Yii::app()->session['IsAuthorized'] == false;
        $this->redirect(Yii::app()->homeUrl);
	}
    
    public function actionCreateRoles(){
        $auth = Yii::app()->authManager;
        $auth->clearAll();
        foreach (Yii::app()->params['users.roles'] as $k=>$v) {
            $auth->createRole($k, $v);    
        }
        $this->redirect('login');
    }
    public function actionSitemap(){
        $start = microtime(true);
		$data = '<?xml version="1.0" encoding="UTF-8"?>
		
<urlset
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";
		$menu = Yii::app()->db->createCommand()
            ->select('id, link')
            ->from('menu')
            ->order('ordering')
            ->queryAll();
		$now = date("Y-m-d\TH:i:sP", time());;
		
		foreach ($menu as $m) {
			$data .= $this->createSiteMapUrlTag(Yii::app()->createAbsoluteUrl($m['link']), $now, '1.0000');
		}
        
        $category_pr = Yii::app()->db->createCommand()
                                ->select('id, alias, updated')
                                ->from('category')
                                ->where('data_type = 1')
                                ->order('updated desc')
                                ->queryAll();
        foreach($category_pr as $r){
            $data.= $this->createSiteMapUrlTag(Yii::app()->createAbsoluteUrl('san-pham/danh-muc/'.$r['alias']),date("Y-m-d\TH:i:sP", strtotime($r['updated'])));
        }
        
        $category_news = Yii::app()->db->createCommand()
                                ->select('id, alias, updated')
                                ->from('category')
                                ->where('data_type = 2')
                                ->order('updated desc')
                                ->queryAll();
        foreach($category_news as $r){
            $data.= $this->createSiteMapUrlTag(Yii::app()->createAbsoluteUrl('tin-tuc/danh-muc/'.$r['alias']),date("Y-m-d\TH:i:sP", strtotime($r['updated'])));
        }
        
        $post = Yii::app()->db->createCommand()
                                ->select('id, alias, updated')
                                ->from('post')
                                ->order('updated desc')
                                ->queryAll();
        foreach($post as $r){
            $data.= $this->createSiteMapUrlTag(Yii::app()->createAbsoluteUrl('tin-tuc/'.$r['alias']),date("Y-m-d\TH:i:sP", strtotime($r['updated'])));
        }
        
        $products = Yii::app()->db->createCommand()
                                ->select('id, alias, updated')
                                ->from('product')
                                ->order('updated desc')
                                ->queryAll();
        foreach($products as $r){
            $data.= $this->createSiteMapUrlTag(Yii::app()->createAbsoluteUrl('san-pham/'.$r['alias']),date("Y-m-d\TH:i:sP", strtotime($r['updated'])));
        }
		
		$data .= '</urlset>';
		$filePath = Yii::getPathOfAlias('webroot').'/sitemap.xml';
		if (file_exists($filePath)){
            $newFile= fopen($filePath, 'w+');
            fwrite($newFile, $data);
            fclose($newFile);
        } else {
            $newFile= fopen($filePath, 'w+');
            fwrite($newFile, $data);
            fclose($newFile);
            chmod($filePath, 0777);
        }
        $end = microtime(true);
        echo 'Tổng thời gian tạo sitemap '.date('i:s', $end-$start);
		//file_put_contents($filePath, $data);
		//echo file_get_contents($filePath);
		Yii::app()->end();
	}
	
	private function createSiteMapUrlTag($url, $lastmod,  $priority = '0.6400', $changefreq = 'monthly') {
		if (!preg_match('%http%isx', $url)) {
			$url = Yii::app()->createAbsoluteUrl($url);
		}
		$result = '<url>
   <loc>'.$url.'</loc>
   <lastmod>'.$lastmod.'</lastmod>
   <changefreq>'.$changefreq.'</changefreq>
   <priority>'.$priority.'</priority>
</url>'."\r\n";
		return $result;
	}
}
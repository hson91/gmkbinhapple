<?php

class SiteController extends Controller
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
                'transparent'=>true,
                'foreColor'=>0x348017,
                'height'=>30,
                'width'=>130,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$models = Product::model()->findAll('status = 1 AND is_hot = 1');
		$this->render('index', array('models'=>$models));
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
	public function actionProduct(){
		$this->render('product');
	}
	public function actionProductByCate(){
		$this->render('product');
	}
	public function actionProductDetail(){
		$this->render('productDetail');
	}
	public function actionAbout(){
		$this->render('about');
	}
	public function actionService(){
		$this->render('service');
	}
	public function actionNew(){
		$this->render('new');
	}
	public function actionNewDetail($alias){
		$this->render('newdetail');
	}
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                $contact = new Contact;
                $contact->attributes=$model->attributes;
                $contact->save(false);
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode('['.Yii::app()->name.'] Liên Hệ Số '.date('dmYHis').': '.$model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".   
					"Content-type: text/plain; charset=UTF-8";
                
                $body = '<table><tr><td colspan="2">Mail được gửi vào lúc '.date('d-m-Y H:i:s').'</td></tr></table>';
                $body .= '<tr><td>Họ tên</td><td>'.$model->name.'</td></tr>';
				$body .= '<tr><td>Email</td><td>'.$model->email.'</td></tr>';
                $body .= '<tr><td>Điện thoại</td><td>'.$model->phone.'</td></tr>';
				$body .= '<tr><td>Nội dung</td><td>'.$model->body.'</td></tr>';
				
                Yii::import('ext.yiimail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody($body, 'text/html');
                $message->subject = $subject;
                $message->addTo(Yii::app()->params['adminEmail']);
                $message->setFrom(array('mail.portal.khoisang@gmail.com'=>Yii::app()->name));
                Yii::app()->mail->send($message);
                
				Yii::app()->user->setFlash('contact','Thanks you for your contact.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
    
}
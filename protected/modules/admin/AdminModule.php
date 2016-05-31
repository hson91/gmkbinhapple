<?php

class AdminModule extends CWebModule
{
    private $_assetsUrl;

    /**
    * @return string the base URL that contains all published asset files of this module.
    */
    public function getAssetsUrl()
    {
        if($this->_assetsUrl===null)
            $this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('admin.assets'));
        return $this->_assetsUrl;
    }
    
    /**
    * @param string the base URL that contains all published asset files of this module.
    */
    public function setAssetsUrl($value)
    {
        $this->_assetsUrl=$value;
    }
    
    public function registerCss($file, $media='all')
    {
        $href = $this->getAssetsUrl().'/css/'.$file;
        return '<link rel="stylesheet" type="text/css" href="'.$href.'" media="'.$media.'" />';
    }
    
    public function registerImage($file)
    {
        return $this->getAssetsUrl().'/images/'.$file;
    }
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
        
		// import the module-level models and components
		$this->setImport(array(
			'admin.components.*',
            'admin.models.*',
		));
        
        Yii::app()->user->loginUrl = Yii::app()->createUrl('admin/site/login');
        Yii::app()->errorHandler->errorAction = 'admin/site/error';
        
        $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
        $this->layout = 'main';
Yii::app()->clientScript->scriptMap=array(
    'jquery.js'=>true
);
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action)) return true;
		else return false;
	}
}
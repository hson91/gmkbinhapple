<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AController extends CController
{
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
    public $breadcrumbs=array();
    public $bgColor = '#1c1c1c';
    public $borderColor = '#171717';
    public $activeColor = '#000';
    public function init()
    {
        Yii::app()->language = 'vi';
        if (isset(Yii::app()->user->role)) {
            if(Yii::app()->user->role == 'user'){
                $this->redirect(Yii::app()->homeUrl);    
                Yii::app()->end();
            }
        }
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        if (isset(Yii::app()->request->cookies['bgColor'])) {
            $this->bgColor = Yii::app()->request->cookies['bgColor']->value;
        }
        if (isset(Yii::app()->request->cookies['borderColor'])){
            $this->borderColor = Yii::app()->request->cookies['borderColor']->value;
        }
        if (isset(Yii::app()->request->cookies['activeColor'])) {
             $this->activeColor = Yii::app()->request->cookies['activeColor']->value;
        }
        
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
    }
    
    public function accessRules()
	{
        
	}
}
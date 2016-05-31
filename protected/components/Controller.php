<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
    
    public $page_title;
    public $keywords;
    public $descriptions;
    public $categories = array();
    public $menulefts;
    
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public function init(){
    	$menuParent = Category::model()->findAll("status = 1 and parent_id = 0");
    	foreach($menuParent as $menu){
            $this->categories[$menu->id] = array("title"=>$menu->title,"alias"=>$menu->alias,"submenu"=>array());
            $menuSub1 = Category::model()->findAll("status = 1 and parent_id = :parent_id",array('parent_id'=>$menu->id));
    		if($menuSub1 != null){
                foreach($menuSub1 as $sub1){
                    $this->categories[$menu->id]["submenu"][$sub1->id] = array("title"=>$sub1->title,"alias"=>$sub1->alias,"submenu"=>array());
                    $menuSub2 = Category::model()->findAll("status = 1 and parent_id = :parent_id",array('parent_id'=>$sub1->id));
                    if($menuSub2 != null){
                        foreach($menuSub2 as $sub2){
                            $this->categories[$menu->id]["submenu"][$sub1->id]['submenu'][$sub2->id] = array("title"=>$sub2->title,"alias"=>$sub2->alias,"submenu"=>array());
                            $menuSub3 = Category::model()->findAll("status = 1 and parent_id = :parent_id",array('parent_id'=>$sub2->id));
                            if($menuSub3 != null){
                                foreach($menuSub3 as $sub3){
                                    $this->categories[$menu->id]["submenu"][$sub1->id]['submenu'][$sub2->id]['submenu'][$sub3->id] = array("title"=>$sub3->title,"alias"=>$sub3->alias,"submenu"=>array());
                                }
                                
                            }
                        }
                        
                    }
                }
                
            }
    	}
    	$this->menulefts = News::model()->findAll();
    }
    
    public function beforeRender($view){
        return true;
    }
}
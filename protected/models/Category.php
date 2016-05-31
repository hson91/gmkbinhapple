<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $image
 * @property integer $data_type
 * @property integer $ordering
 * @property integer $status
 * @property string $note
 * @property string $meta_key
 * @property string $meta_desc
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 *
 * The followings are the available model relations:
 * @property Category $parent
 * @property Category[] $productCategory
 * @property Product[] $products
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, status', 'numerical', 'integerOnly'=>true),
			array('title, alias, image', 'length', 'max'=>255),
            array('alias', 'unique'),
			array('note, meta_key, meta_desc, updated, inserted, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, title, alias, image, data_type, status, description, note, meta_key, meta_desc, updated, inserted', 'safe'),
			array('id, parent_id, title, alias, image, data_type, status, description, note, meta_key, meta_desc, updated, inserted', 'safe', 'on'=>'search'),
		);
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'products' => array(self::HAS_MANY, 'Product', 'category_id'),
            'parentCate' => array(self::BELONGS_TO,'Category','parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' =>'DM Cha',
			'title' => 'Tiêu Đề',
			'alias' => 'Link',
			'image' => 'Hình Ảnh',
			'data_type' => 'Loại Danh Mục',
			'status' => 'Tình Trạng',
            'description'=>'Bài viết',
			'note' => 'Ghi Chú',
			'meta_key' => 'Meta Key',
			'meta_desc' => 'Meta Desc',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.alias',$this->alias,true);
		$criteria->compare('t.image',$this->image,true);
		$criteria->compare('t.status',$this->status);
        $criteria->compare('t.description',$this->description);
		$criteria->compare('t.note',$this->note,true);
		$criteria->compare('t.meta_key',$this->meta_key,true);
		$criteria->compare('t.meta_desc',$this->meta_desc,true);
		$criteria->compare('t.updated',$this->updated,true);
		$criteria->compare('t.inserted',$this->inserted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
            'sort'=>array(
                'defaultOrder'=>'t.updated DESC',
            ),
		));
	}
    public function cateParent(){
    	$arr = array();
    	$arr[0] = 'Danh mục Cha';
        $models = self::model()->findAll('parent_id = 0 AND status = 1');
        
        if($models != null){
        	foreach($models as $r){
	            $arr[$r->id] = $r->title;
	            $submenu = self::model()->findAll('parent_id = :parent_id',array(':parent_id' => $r->id));
	            if($submenu != null){
	            	foreach($submenu as $sub){
	            		$arr[$sub->id] = "|---".$sub->title;
	            		$submenu1 = self::model()->findAll('parent_id = :parent_id',array(':parent_id' => $sub->id));
			            if($submenu1 != null){
			            	foreach($submenu1 as $sub1){
			            		$arr[$sub1->id] = "||||||---".$sub1->title;
			            	}
			            }
	            	}
	            }
	        }
        }
        return $arr;
    }
    public function getSubCate(){
    	return self::model()->findAll('parent_id = :parent_id',array(':parent_id' => $this->id));
    }
    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->inserted = time();
        }
        $this->updated = time();
        return true;
    }
}
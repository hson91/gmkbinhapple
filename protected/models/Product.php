<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $alias
 * @property string $image
 * @property string $short_desc
 * @property string $full_desc
 * @property integer $ordering
 * @property integer $status
 * @property string $note
 * @property string $oprice
 * @property string $price
 * @property integer $discount
 * @property integer $category_id
 * @property string $meta_key
 * @property string $meta_desc
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $manufacturer_id
 * @property string $status_text
 * @property string $iv_desc
 * @property string $color
 * @property string $warranty
 *
 * The followings are the available model relations:
 * @property ProductImages[] $productImages
 * @property Category $category
 */
class Product extends CActiveRecord
{   
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_hot, is_new, status, category_id', 'numerical', 'integerOnly'=>true),
			array('title, alias,', 'length', 'max'=>255),
            array('alias','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, image, summary, description, status, prices, promotion, category_id, meta_key, meta_desc, is_hot, is_new, status_text, color_text, updated, inserted', 'safe'),
			array('id, title, alias, image, summary, description, status, prices, promotion, category_id, meta_key, meta_desc, is_hot, is_new, status_text, color_text, updated, inserted', 'safe', 'on'=>'search'),
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
			'cate' => array(self::BELONGS_TO, 'Category', 'category_id')
		);
	}
    public static function getCate($cateid){
        $r =  Yii::app()->db->createCommand('select title from category where id = '.$cateid)->queryScalar();
        if($r){
            return $r;
        }else{
            return '';
        }
    }
    public static function getCatealias($cateid){
        $r =  Yii::app()->db->createCommand('select alias from category where id = '.$cateid)->queryScalar();
        if($r){
            return $r;
        }else{
            return '';
        }
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Tiêu Đề',
			'alias' => 'Link',
			'image' => 'Hình Ảnh',
			'summary' => 'Mô Tả Ngắn',
			'description' => 'Mô Tả',
			'status' => 'Tính Trạng',
			'prices' => 'Giá Gốc',
			'promotion' => 'Giá KM',
			'category_id' => 'Danh Mục',
			'meta_key' => 'Meta Key',
			'meta_desc' => 'Meta Desc',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
            'is_new' => 'SP Mới',
            'is_hot' => 'SP Nỗi Bật',
            'status_text' => 'Tình Trang SP', 
            'color_text' => 'Màu Sắc'
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
		$criteria->compare('t.summary',$this->summary,true);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.category_id',$this->category_id);
		$criteria->compare('t.meta_key',$this->meta_key,true);
		$criteria->compare('t.meta_desc',$this->meta_desc,true);
        $criteria->compare('t.is_hot',$this->is_hot);
        $criteria->compare('t.is_new',$this->is_new);

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
    
    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->inserted = time();
        }
        $this->updated = time();
        return true;
    }
}
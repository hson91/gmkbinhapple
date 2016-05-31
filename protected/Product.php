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
class Product extends CActiveRecord implements IECartPosition
{   
    public $images;
    public function getId(){
        return $this->id;
    }

    public  function getPrice(){
    	if($this->discount >0){
    		return $this->discount;
    	}
        return $this->price;
    }
    
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
			array('ordering, manufacturer_id, is_hot, is_new, status, discount, category_id, updater, inserter', 'numerical', 'integerOnly'=>true),
			array('title, alias,', 'length', 'max'=>255),
            array('alias','unique'),
			array('image, images, oprice, status_text, iv_desc, color, warranty, price,discount,text_discount,color_discount, short_desc, code, full_desc, note, meta_key, meta_desc, updated, inserted', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, manufacturer_id, alias, image, short_desc, full_desc, ordering, status, note, oprice, price, discount,text_discount,color_discount, category_id, meta_key, meta_desc, updated, inserted, updater, inserter', 'safe'),
			array('id, title, manufacturer_id, alias, image, short_desc, full_desc, ordering, status, note, oprice, price, discount,text_discount,color_discount, category_id, meta_key, meta_desc, updated, inserted, updater, inserter', 'safe', 'on'=>'search'),
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
			'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_id', 'order'=>'ordering'),
			'cate' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'manufacturer' => array(self::BELONGS_TO, 'Manufacturer', 'manufacturer_id'),
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
			'alias' => 'Tiêu Đề SEO',
			'image' => 'Hình Ảnh',
			'short_desc' => 'Mô Tả Ngắn',
			'full_desc' => 'Mô Tả',
			'ordering' => 'Thứ Tự',
			'status' => 'Tính Trạng',
			'note' => 'Ghi Chú',
			'oprice' => 'Giá Gốc',
			'price' => 'Giá',
			'discount' => 'Giảm Giá (%)',
            'text_discount'=>'Text khuyến mãi',
            'color_discount'=>'Màu chữ khuyến mãi',
			'category_id' => 'Danh Mục',
			'meta_key' => 'Meta Key',
			'meta_desc' => 'Meta Desc',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
			'updater' => 'Người Cập Nhật',
			'inserter' => 'Người Tạo',
            'is_new' => 'SP Mới',
            'is_hot' => 'SP Nỗi Bật',
            'code' => 'Mã SP',
            'manufacturer_id' => 'Nhà Sản Xuất',
            'images' => 'Hình Con(s)',
            'enable_color' => 'Cho Chọn Màu',
            'status_text' => 'Tình Trang SP', 
            'iv_desc' => 'Hình Ảnh &amp; Video', 
            'color' => 'Màu Sắc', 
            'warranty' => 'Bảo Hành',
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
		$criteria->compare('t.short_desc',$this->short_desc,true);
		$criteria->compare('t.full_desc',$this->full_desc,true);
		$criteria->compare('t.ordering',$this->ordering);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.oprice',$this->oprice,true);
		$criteria->compare('t.price',$this->price,true);
		$criteria->compare('t.discount',$this->discount);
		$criteria->compare('t.category_id',$this->category_id);
		$criteria->compare('t.meta_key',$this->meta_key,true);
		$criteria->compare('t.meta_desc',$this->meta_desc,true);
		$criteria->compare('t.updated',$this->updated,true);
		$criteria->compare('t.inserted',$this->inserted,true);
        $criteria->compare('t.code',$this->code,true);
		$criteria->compare('t.updater',$this->updater);
		$criteria->compare('t.inserter',$this->inserter);
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
            $this->inserted = new CDbExpression('NOW()');
            $this->inserter = Yii::app()->user->id;
        }
        $this->updated = new CDbExpression('NOW()');
        $this->updater = Yii::app()->user->id;
        $this->category_id = Category::model()->exists('id=:id AND (data_type=1 OR data_type=3)', array(':id'=>$this->category_id))?$this->category_id:NULL;
        $this->manufacturer_id = Manufacturer::model()->exists('id=:id', array(':id'=>$this->manufacturer_id))?$this->manufacturer_id:NULL;
        return true;
    }
}
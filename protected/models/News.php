<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $image
 * @property string $short_desc
 * @property string $full_desc
 * @property integer $ordering
 * @property integer $status
 * @property string $note
 * @property integer $category_id
 * @property integer $enable_home
 * @property string $tags
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 * @property string $meta_key
 * @property string $meta_desc
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cate_id', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('id, cate_id, title, alias, image, summary, description, status, note, meta_key, meta_desc, updated, inserted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cate_id, title, alias, image, summary, description, status, note, meta_key, meta_desc, updated, inserted', 'safe', 'on'=>'search'),
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
			'category'=>array(self::BELONGS_TO, 'NewCate', 'cate_id'),
		);
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
			'cate_id' => 'Danh Mục',
			'status' => 'Tình Trạng',
			'note' => 'Ghi Chú',
			'meta_key' => 'Meta Key',
			'meta_desc' => 'Meta Desc',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
            'enable_home' => 'Hiện Trang Chủ',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('note',$this->note,true);
        $criteria->compare('cate_id',$this->cate_id);    
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('inserted',$this->inserted,true);
		$criteria->compare('meta_key',$this->meta_key,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
        $criteria->compare('enable_home',$this->enable_home);
        
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slideshow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}


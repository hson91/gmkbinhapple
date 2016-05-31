<?php

/**
 * This is the model class for table "slideshow".
 *
 * The followings are the available columns in table 'slideshow':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property integer $ordering
 * @property integer $status
 * @property string $link
 * @property integer $new_tab
 * @property string $note
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 * @property string $short_desc
 */
class Slideshow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slideshow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ordering, status, new_tab, updater, inserter', 'numerical', 'integerOnly'=>true),
			array('title, image', 'length', 'max'=>255),
			array('link, short_desc, updated, inserted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image, ordering, status, link, new_tab, updated, inserted', 'safe', 'on'=>'search'),
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
			'image' => 'Hình Ảnh',
			'ordering' => 'Thứ Tự',
			'status' => 'Tình Trạng',
			'link' => 'Link',
			'new_tab' => 'Tab Mới',
			'note' => 'Ghi Chú',
			'updated' => 'Ngày cập nhật',
			'inserted' => 'Ngày Tạo',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('status',$this->status);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('new_tab',$this->new_tab);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
            'sort'=>array(
                'defaultOrder'=>'updated DESC',
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

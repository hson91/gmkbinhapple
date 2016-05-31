<?php

/**
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property integer $id
 * @property string $title
 * @property string $var
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 * @property string $content
 * @property string $html_content
 * @property string $image
 * @property integer $config_type
 * @property string $link
 */
class Config extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Config the static model class
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
		return 'config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('config_type', 'numerical', 'integerOnly'=>true),
            array('title, var','required'),
			array('title', 'length', 'max'=>255),
			array('var', 'length', 'max'=>20),
			array('content, html_content, image, link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, var, content, html_content, image, config_type, link, updated, inserted', 'safe', 'on'=>'search'),
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
			'var' => 'Tên Biến',
			'content' => 'Nội Dung Thường',
			'html_content' => 'Nội Dung HTML',
			'image' => 'Hình Ảnh',
			'config_type' => 'Loại Cấu Hình',
			'link' => 'Link',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
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
		$criteria->compare('t.var',$this->var,true);
		$criteria->compare('t.content',$this->content,true);
		$criteria->compare('t.html_content',$this->html_content,true);
		$criteria->compare('t.image',$this->image,true);
		$criteria->compare('t.config_type',$this->config_type);
		$criteria->compare('t.link',$this->config_type,true);

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
            $this->inserted = time()
        }
        $this->updated = time();
        return true;
    }
}
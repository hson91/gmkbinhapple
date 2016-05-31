<?php

/**
 * This is the model class for table "seo".
 *
 * The followings are the available columns in table 'seo':
 * @property integer $id
 * @property string $link
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 * @property string $title
 * @property string $meta_key
 * @property string $meta_desc
 * @property string $note
 */
class Seo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seo the static model class
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
		return 'seo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updater, inserter', 'numerical', 'integerOnly'=>true),
            array('link', 'unique'),
			array('link, updated, inserted, title, meta_key, meta_desc, note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, link, updated, inserted, updater, inserter, title, meta_key, meta_desc, note', 'safe', 'on'=>'search'),
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
			'link' => 'Link',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
			'title' => 'title',
			'meta_key' => 'Meta Key',
			'meta_desc' => 'Meta Desc',
			'note' => 'Ghi Chú',
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
		$criteria->compare('t.link',$this->link,true);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.meta_key',$this->meta_key,true);
		$criteria->compare('t.meta_desc',$this->meta_desc,true);
		$criteria->compare('t.note',$this->note,true);

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
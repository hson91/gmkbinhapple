<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property integer $status
 * @property string $note
 * @property string $subject
 * @property string $body
 * @property string $updated
 * @property string $inserted
 * @property integer $updater
 * @property integer $inserter
 *
 * The followings are the available model relations:
 * @property ReportDetails[] $reportDetails
 */
class Contact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name, email, subject, body','required'),
			array('status','numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>100),
            array('email','email'),
			array('phone', 'length', 'max'=>40),
			array('address, subject, body, note, updated, inserted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email, address, phone, status, note, subject,body, updated, inserted', 'safe', 'on'=>'search'),
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
			'name' => 'Họ Tên',
			'email' => 'Email',
			'address' => 'Địa Chỉ',
            'subject' => 'Tiêu Đề',
            'body' => 'Nội Dung',
			'phone' => 'Điện Thoại',
			'status' => 'Tình Trạng',
			'note' => 'Ghi Chú',
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
			'updater' => 'Người Cập Nhật',
			'inserter' => 'Người Tạo',
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.address',$this->address,true);
		$criteria->compare('t.phone',$this->phone,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.note',$this->note,true);
        $criteria->compare('t.subject',$this->subject,true);
        $criteria->compare('t.body',$this->body,true);

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
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

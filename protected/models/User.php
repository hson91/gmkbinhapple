<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $updated
 * @property string $inserted
 * @property string $updater
 * @property string $inserter
 * @property string $username
 * @property string $password
 * @property string $roles
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $gender
 * @property string $dob
 * @property string $address
 * @property string $phone
 * @property string $status
 * @property string $yahoo
 * @property string $skype
 * @property string $visited
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updater, inserter, gender, status', 'length', 'max'=>11),
			array('username', 'length', 'max'=>32),
			array('password', 'length', 'max'=>64),
			array('first_name, last_name, email', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>40),
			array('updated, inserted, address, visited', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, updated, inserted, updater, inserter, username, password, first_name, last_name, email, gender, address, phone, status, visited', 'safe', 'on'=>'search'),
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
			'updated' => 'Ngày Cập Nhật',
			'inserted' => 'Ngày Tạo',
			'updater' => 'Người Cập Nhật',
			'inserter' => 'Người Tạo',
			'username' => 'Tên Đăng Nhập',
			'password' => 'Mật Khẩu',
			'first_name' => 'Tên',
			'last_name' => 'Họ',
			'email' => 'Email',
			'gender' => 'Giới Tính',
			'dob' => 'Ngày Sinh',
			'address' => 'Địa Chỉ',
			'phone' => 'Điện Thoại',
			'status' => 'Tình Trạng',
			'yahoo' => 'Yahoo',
			'skype' => 'Skype',
			'visited' => 'Ngày Đăng Nhập Cuối',
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
		$criteria->compare('t.updated',$this->updated,true);
		$criteria->compare('t.inserted',$this->inserted,true);
		$criteria->compare('t.updater',$this->updater,true);
		$criteria->compare('t.inserter',$this->inserter,true);
		$criteria->compare('t.username',$this->username,true);
		$criteria->compare('t.password',$this->password,true);
		$criteria->compare('t.first_name',$this->first_name,true);
		$criteria->compare('t.last_name',$this->last_name,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.gender',$this->gender,true);
		$criteria->compare('t.address',$this->address,true);
		$criteria->compare('t.phone',$this->phone,true);
        $criteria->compare('t.status',$this->status,true);
		$criteria->compare('t.visited',$this->visited,true);

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
        return true;
    }
}
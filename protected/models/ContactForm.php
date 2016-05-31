<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $company;
	public $address;
	public $email;
    public $phone;
	public $subject;
	public $body;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, company, address, email, phone, subject, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
            array('phone','safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
            'name'=>'Họ Tên',
            'company'=>'Công ty',
            'address'=>'Địa chỉ',
            'email'=>'Email',
            'phone'=>'Điện Thoại',
            'subject'=>'Tiêu Đề',
            'body'=>'Nôi Dung',
		);
	}
}
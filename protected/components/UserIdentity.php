<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = User::model()->findByAttributes(array(
            'username'=>$this->username,
            'status'=>1,
        )); 

        
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $password = md5($this->password);
            
            if ($user->password !== $password) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_id = $user->id;
                if ($user->visited === null) {
                    $lastLogin = new CDbExpression('NOW()');
                } else {
                    $lastLogin = $user->visited;
                }
                
                $user->visited = new CDbExpression('NOW()');
            
                $user->save(false);
                
                
                $auth = Yii::app()->authManager;
                
                if (!$auth->isAssigned($user->roles, $this->_id)) {
                    if ($auth->assign($user->roles, $this->_id)) {
                        Yii::app()->authManager->save();
                    }
                }
                
                $this->setState('role', $user->roles);
                $this->setState('username', $user->username);
                $this->setState('first_name', $user->first_name);
                $this->setState('last_name', $user->last_name);
                $this->setState('email', $user->email);
                $this->setState('visited', $lastLogin);
                Yii::app()->session['IsAuthorized'] = true;
                $this->errorCode = self::ERROR_NONE;
            }
        }
		return !$this->errorCode;
	}
    
    public function getId(){
        return $this->_id;
    }
}
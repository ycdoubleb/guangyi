<?php
namespace common\models;

use wskeee\rbac\RbacManager;
use wskeee\rbac\RbacName;
use Yii;
use yii\base\Model;
use yii\web\UserEvent;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login($checkRbac = true)
    {
        if ($this->validate()) {
             /* @var $user User */
            $user = $this->getUser();
            if($checkRbac)
            {
                Yii::$app->getUser()->on(\yii\web\User::EVENT_BEFORE_LOGIN, function($event){
                    /* @var $event UserEvent */
                    /* @var $authManager RbacManager */
                    $authManager = Yii::$app->getAuthManager();
                    $event->isValid = $authManager->isRole(RbacName::ROLE_ADMIN,$this->getUser()->id);
                    if(!$event->isValid)
                        $this->addError('username', '错误账号或无权限登录!');
               });
            }
            
            return Yii::$app->user->login($user, $this->rememberMe ? 0 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    public function attributeLabels() {
        return [
            'username' =>Yii::t('rcoa', 'Username'),
            'password' => Yii::t('rcoa', 'Password'),
            'rememberMe'=> Yii::t('rcoa', 'RememberMe'),
        ];
    }
}

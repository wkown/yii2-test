<?php

namespace app\models;

use Yii;
use app\models\UserProfile;
/**
 * This is the model class for table "{{%User}}".
 *
 * @property string $user_id
 * @property string $username
 * @property string $password
 * @property string $mobile
 * @property string $email
 * @property string $auth_key
 * @property string $regip
 * @property integer $regdate
 * @property string $lastloginip
 * @property integer $lastlogintime
 * @property string $salt
 * @property integer $type
 * @property integer $bind_qq
 * @property integer $bind_wb
 *
 * @property UserProfile $profile
 * @property UserAccount $account
 */
class User extends \app\components\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    private  $_profile;
    private  $_account;
    public static function tableName()
    {
        return '{{%user}}';
    }

    /*public function scenarios()
    {
        return [
            'login' => ['username', 'password'],
            'register' => ['username', 'mobile', 'password'],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'/*, 'mobile', 'email', 'salt'*/], 'required'],
            [['regip', 'regdate', 'lastloginip', 'lastlogintime', 'type', 'bind_qq', 'bind_wb'], 'integer'],
            [['username', 'mobile'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 32],
            [['salt'], 'string', 'max' => 6],
            [['username'], 'unique'],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '用户ID',
            'username' => '用户名',
            'password' => '密码',
            'mobile' => '手机号',
            'email' => '邮箱',
            'regip' => '注册IP',
            'regdate' => '注册时间',
            'lastloginip' => '最后登录IP',
            'lastlogintime' => '最后登录时间',
            'salt' => '盐',
            'type' => '类型',
            'bind_qq' => '是否绑定qq',
            'bind_wb' => '是否绑定微博',
        ];
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password){
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * 属性对应 UserProfile
     * 方便直接通过User 获取Userprofile
     *
     * @return UserProfile
     */
    public function getProfile()
    {
        if($this->_profile) return $this->_profile;
        $this->_profile=UserProfile::findOne(['user_id'=>$this->user_id]);
        if($this->_profile)
            return $this->_profile;
        else
        {

            $this->_profile=new UserProfile();
            $this->_profile->user_id=$this->user_id;
            $this->_profile->save();
            return $this->_profile;
        }
    }

    /**
     * @return UserAccount
     */
    public function getAccount(){
        if($this->_account) return $this->_account;
        $this->_account=UserAccount::findOne(['user_id'=>$this->user_id]);
        if($this->_account)
            return $this->_account;
        else
        {

            $this->_account=new UserProfile();
            $this->_account->user_id=$this->user_id;
            $this->_account->save();
            return $this->_account;
        }
        //return $this->hasOne(UserAccount::className(),['user_id'=>'user_id'] );
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id'=>$id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        if(!$this->auth_key){
            $this->auth_key = md5($this->username);
        }
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}

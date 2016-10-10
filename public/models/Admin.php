<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $admin_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property string $lastloginip
 * @property integer $lastlogintime
 * @property string $salt
 * @property integer $type
 */
class Admin extends \app\components\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'auth_key', 'salt'], 'required'],
            [['lastloginip', 'lastlogintime', 'type'], 'integer'],
            [['username'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 60],
            [['email', 'auth_key'], 'string', 'max' => 32],
            [['salt'], 'string', 'max' => 6],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'lastloginip' => 'Lastloginip',
            'lastlogintime' => 'Lastlogintime',
            'salt' => 'Salt',
            'type' => 'Type',
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['admin_id'=>$id]);
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
        return $this->admin_id;
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

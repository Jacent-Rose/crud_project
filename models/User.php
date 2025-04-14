<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users'; // Make sure you have a 'user' table in your database
    }

    public function rules()
    {
        return [
            [['phone_number', 'created_by'], 'default', 'value' => null],
            [['username', 'first_name', 'last_name', 'gender', 'password', 'email'], 'required'],
            [['username', 'first_name', 'last_name', 'password', 'email'], 'string'],
            [['created_at'], 'safe'],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['gender'], 'string', 'max' => 10],
            [['phone_number'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['first_name', 'last_name'], 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Only letters and spaces are allowed.'], // Alphabet only
            [['username'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['created_by' => 'id']],
            [
                ['phone_number'],
                'match',
                'pattern' => '/^\+([1-9]{1}[0-9]{1,3})\d{9,14}$/',
                'message' => 'Phone number must start with + followed by a valid country code and number'
            ],
            // Password validation rules
            [['password'], 'string', 'min' => 8, 'tooShort' => 'Password should be at least 8 characters long.'],
            [['password'], 'match', 'pattern' => '/[A-Za-z]/', 'message' => 'Password must contain at least one letter.'],
            [['password'], 'match', 'pattern' => '/\d/', 'message' => 'Password must contain at least one number.'],
            [
                ['password'],
                'match',
                'pattern' => '/[^A-Za-z0-9]/',
                'message' => 'Password must contain at least one special character (e.g. @, #, $, etc.).'
            ],
            // Password confirmation validation
            [
                ['password_confirmation'],
                'compare',
                'compareAttribute' => 'password',
                'message' => 'Passwords do not match.'
            ],
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }


    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }



    //Not there

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }
}
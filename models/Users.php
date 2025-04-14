<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $password
 * @property string|null $phone_number
 * @property string $email
 * @property string|null $created_at
 * @property int|null $created_by
 *
 * @property Users $createdBy
 * @property Posts[] $posts
 * @property Users[] $users
 */
class Users extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public $confirm_password;

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
            [['first_name', 'last_name'], 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Only letters and spaces are allowed.'], // Alphabet only
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['created_by' => 'id']);
    }
}

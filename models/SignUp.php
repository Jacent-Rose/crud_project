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


class SignUp extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
   

    /**
     * {@inheritdoc}
     */
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    
    public function rules()
    {
        return [
        
            [['username'], 'required'],
            [['username'], 'string'],
            [['first_name'], 'string', 'max' => 255],
            [['last_name'], 'string', 'max' => 255],
            // Password validation rules
            [['password'], 'string', 'min' => 4, 'tooShort' => 'Password should be at least 8 characters long.'],
        ];
    }

    
public function signup()
{
    if (!$this->validate()) { // Correct validation check
        return null; // Stop if validation fails
    }
    $user = new User(); // Create a new User object
    $user->username = $this->username; // Set the username
    $user->first_name = $this->first_name; // Set the first name
    $user->last_name = $this->last_name; // Set the last name
    $user->setPassword($this->password); // Set the password
    return $user->save() ? $user : null; // Save the user to the database
}
}

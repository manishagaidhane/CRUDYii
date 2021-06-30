<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name', 'email', 'phone_number'], 'required'],

            [['phone_number'],'number'],
            [['phone_number'], 'string', 'min' =>10,  'max' => 10, 'tooShort' =>'Only 10 digits are allowed.'],
            [['phone_number'], 'unique'],
            [['name'],'string'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Name can only be in letters.'],            
            [['email'], 'email',  'message' => 'Enter valid email id (eg. abc@xyz.com).'],

            [['email'], 'unique'],
            
            //[['phone_number'], 'in', 'range' => (10,12)]
            //['phone_number', 'match', 'pattern' => '/^.[10,12]$/', 'message' => 'Phone Number can only beetween 10 - 12 digits.'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Full Name',
            'email' => 'Email',
            'phone_number' => 'Phone',
        ];
    }
}

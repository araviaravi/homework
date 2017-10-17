<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $DOB
 * @property string $profilepic
 * @property string $address
 * @property string $created_at
 */
class Contact extends \yii\db\ActiveRecord
{
  

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'mobile', 'DOB', 'profilepic', 'address'], 'required'],
            [['DOB', 'created_at'], 'safe'],
            [['address'], 'string'],
            [['name', 'email', 'mobile','profilepic' ], 'string', 'max' => 55],
            [['profilepic'],'file','extensions'=>'jpg,png,gif','skipOnEmpty'=>false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'DOB' => 'Date of birth',
            'profilepic' => 'Profile image',
            'address' => 'Address',
            'created_at' => 'Created At',
        ];
    }

}

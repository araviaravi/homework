<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property string $vender_name
 * @property string $country
 * @property string $state
 * @property string $cities
 * @property int $phonecode
 * @property string $phonenumber
 * @property string $email
 * @property string $product
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vender_name', 'country', 'state', 'cities', 'phonecode', 'phonenumber', 'email', 'product'], 'required'],
            [['phonecode'], 'integer'],
            [['vender_name', 'country', 'state', 'cities', 'phonenumber', 'email', 'product'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vender_name' => Yii::t('app', 'Vender Name'),
            'country' => Yii::t('app', 'Country'),
            'state' => Yii::t('app', 'State'),
            'cities' => Yii::t('app', 'Cities'),
            'phonecode' => Yii::t('app', 'Phonecode'),
            'phonenumber' => Yii::t('app', 'Phonenumber'),
            'email' => Yii::t('app', 'Email'),
            'product' => Yii::t('app', 'Product'),
        ];
    }
}

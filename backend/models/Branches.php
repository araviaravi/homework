<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $branch_id
 * @property int $companies_company_id
 * @property string $branch_name
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companies_company_id', 'branch_name'], 'required'],
            [['companies_company_id'], 'integer'],
            [['branch_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => Yii::t('app', 'Branch ID'),
            'companies_company_id' => Yii::t('app', 'Companies Company ID'),
            'branch_name' => Yii::t('app', 'Branch Name'),
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $department_id
 * @property int $branches_branch_id
 * @property int $companies_company_id
 * @property string $department_name
 * @property string $status
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branches_branch_id', 'companies_company_id', 'department_name', 'status'], 'required'],
            [['branches_branch_id', 'companies_company_id'], 'integer'],
            [['status'], 'string'],
            [['department_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => Yii::t('app', 'Department ID'),
            'branches_branch_id' => Yii::t('app', 'Branches Branch ID'),
            'companies_company_id' => Yii::t('app', 'Companies Company ID'),
            'department_name' => Yii::t('app', 'Department Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}

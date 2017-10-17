<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Companies;
use app\models\Branches;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

         <?= $form->field($model, 'companies_company_id')->dropDownList(
            ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
             ['prompt'=>'Select Company',
              'onchange'=>'
                $.post( "index.php?r=branches/lists&id="+$(this).val(), function( data ) {
                  $( "select#departments-branches_branch_id" ).html( data );
                });'
            ]); ?>

        <?= $form->field($model, 'branches_branch_id')->dropDownList(
            ArrayHelper::map(Branches::find()->all(), 'branch_id', 'branch_name'),
             ['prompt'=>'Select Baranch',              
            ]); ?>       


        <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

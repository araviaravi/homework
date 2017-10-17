<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;
use app\models\Cities;
use app\models\Countries;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'vender_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'country')->dropDownList(
            ArrayHelper::map(Countries::find()->all(), 'id', 'name'),
             ['prompt'=>'Select country']); ?>

         <?= $form->field($model, 'state')->dropDownList(
            ArrayHelper::map(States::find()->all(), 'id', 'name'),
             ['prompt'=>'Select State']); ?>

        <?= $form->field($model, 'cities')->dropDownList(
            ArrayHelper::map(Cities::find()->all(), 'id', 'name'),
             ['prompt'=>'Select cities']); ?>        

        <?= $form->field($model, 'phonecode')->textInput(['readonly'=>'true']) ?>

        <?= $form->field($model, 'phonenumber')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJS('
        // vendor-country
        // vendor-state
        //    vendor-cities
        // vendor-phonecode
        var change_in_progression = 0;
        /** For change of country code */
        $("#vendor-country").change(function(){
            /* To set phonecode */
            $.post( "index.php?r=vendor/phonecodecountry&id="+$(this).val(), function( data ) { 
                $( "#vendor-phonecode" ).val( data );
            });       
            if(change_in_progression == 0){
                window.change_in_progression = 1;
                /** To set state */
                $.post( "index.php?r=vendor/statescountry&id="+$(this).val(), function( data ) { 
                  $( "select#vendor-state" ).html( data );
                });
                /** To set cities */
                $.post( "index.php?r=vendor/citiescountry&id="+$(this).val(), function( data ) { 
                  $( "select#vendor-cities" ).html( data );
                });
                setTimeout(function(){window.change_in_progression = 0; }, 500);
            } 
        });

        /** For change in state */
        $("#vendor-state").change(function(){

            /** To set country */
            $.post( "index.php?r=vendor/countrystate&id="+$(this).val(), function( data ) { 
                $("#vendor-country").val(data).change();
            });   

            if(change_in_progression == 0){
                window.change_in_progression = 1;  
                
                /** To set cities */
                $.post( "index.php?r=vendor/citiesstate&id="+$(this).val(), function( data ) { 
                  $( "select#vendor-cities" ).html( data );
                });
                setTimeout(function(){window.change_in_progression = 0; }, 500);
            }
            
        });

        /** For change in city */
        $("#vendor-cities").change(function(){
            if(change_in_progression == 0){
                window.change_in_progression = 1;   
                
                /** To change state and country */
                $.post( "index.php?r=vendor/citychanged&id="+$(this).val(), function( data ) { 
                $("#vendor-state").val(data).change();
                });
                setTimeout(function(){window.change_in_progression = 0; }, 500);
            }
            
        });



    ',yii\web\View::POS_END );
?>
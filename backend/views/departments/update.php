<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Departments',
]) . $model->department_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->department_id, 'url' => ['view', 'id' => $model->department_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="departments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

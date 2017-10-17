<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Branches */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Branches',
]) . $model->branch_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->branch_id, 'url' => ['view', 'id' => $model->branch_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="branches-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

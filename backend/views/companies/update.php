<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Companies',
]) . $model->company_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_id, 'url' => ['view', 'id' => $model->company_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="companies-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

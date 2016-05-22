<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\yorum\models\Tip */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tip',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Guncelle');
?>
<div class="tip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

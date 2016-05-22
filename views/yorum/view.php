<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\yorum\models\Yorum */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yorums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yorum-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Guncelle'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Sil'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'yazans.username',
            'baslik',
            'icerik:ntext',
           
        ],
    ]) ?>

</div>

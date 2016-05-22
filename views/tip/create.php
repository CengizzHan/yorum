<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\yorum\models\Tip */

$this->title = Yii::t('app', 'Create Tip');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

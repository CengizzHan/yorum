<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use cengizzhan\yorum\models\Tip;
use yii\helpers\ArrayHelper;
 $types = ArrayHelper::map(Tip::find()->all(),'id','isim');
/* @var $this yii\web\View */
/* @var $model backend\modules\yorum\models\Yorum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yorum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'baslik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icerik')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tip')->dropdownList($types) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

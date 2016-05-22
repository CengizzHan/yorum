<?php
/* @var $this yii\web\View */

echo \yii\widgets\ListView::widget([
'dataProvider'=>$provider,
'itemView'=>function($model)
{
	return '<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading">'.$model->icerik.'</h4>
    <p class="list-group-item-text">'.$model->baslik.'</p>
  </a>
</div>';
}


]);
?>

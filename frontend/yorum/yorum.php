<?php
/* @var $this yii\web\View */
use yii\db\Query;
echo \yii\widgets\ListView::widget([
'dataProvider'=>$provider,
'itemView'=>function($model)
{
 $query = new Query;
 $kullanici_adi=$model->yazan;
 $query ->select('username')
   ->from('user')
   ->where (['id' =>$kullanici_adi]);

 $command = $query->createCommand();
 $kullanici = $command->queryOne();
 
	return '<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading"> Yazar : '.$kullanici['username'].'</h4>
    <p class="list-group-item-text">Baslık : '.$model->baslik.'</p>
	 <p class="list-group-item-text">'.$model->icerik.'</p>
	
  </a>
</div>';
}


]);
?>

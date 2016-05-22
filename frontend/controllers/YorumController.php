<?php

namespace frontend\controllers;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use backend\modules\yorum\models\Yorum;
class YorumController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	public function actionYorum()
    {
	 $query=new Query();
     $provider = new ActiveDataProvider([
	 'query'=>Yorum::find(),
	 'pagination' =>[
	 'pagesize' =>5,
	 ],
	]);
	return $this->render('yorum',['provider'=>$provider,
]);		
    }

}

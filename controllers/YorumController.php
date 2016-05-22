<?php

namespace cengizzhan\yorum\controllers;

use Yii;
use cengizzhan\yorum\models\Yorum;
use cengizzhan\yorum\models\YorumSearch;
use cengizzhan\yorum\models\Tip;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * YorumController implements the CRUD actions for Yorum model.
 */
class YorumController extends Controller
{
    public function behaviors()
    {
        return [
		'access'=>[
				'class'=>AccessControl::classname(),
				'rules'=>[
					[
						'actions'=>['index','view','create','update','delete'],
						'allow'=>true,
						'roles'=>['@'],
					],				
				],	
			],
		
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Yorum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YorumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Yorum model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Yorum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->can('yorumekle'))
		{
               $model = new Yorum();
             $types = ArrayHelper::map(Tip::find()->all(),'id','isim');
      if ($model->load(Yii::$app->request->post()) && Yii::$app->user->getId() != null) {
				$model->yazan = Yii::$app->user->getId();
				
				if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
					'model' => $model,
					'types' => $types,
				]);
			}	
		} else{
			Yii::$app->session->setFlash('error', 'İçerik oluşturma yetkiniz yok');
			$this->redirect(['index']);
			}
    }

    /**
     * Updates an existing Yorum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {  
	        $model = $this->findModel($id);
		if (Yii::$app->user->can('yorumguncelle', ['yorum' => $model])) {
      
              $types = ArrayHelper::map(Tip::find()->all(),'id','isim');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'types' => $types,
            ]);
        }
		}else{
			Yii::$app->session->setFlash('error', 'Sadece kendi içeriklerinizi güncelleyebilirsiniz!');
			$this->redirect(['index']);
		}
    }

    /**
     * Deletes an existing Yorum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if (Yii::$app->user->can('yorumsil')) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
		}
		 else{
   Yii::$app->session->setFlash('error', 'Sadece Yetkili Kullanıcı Silme İşlemi Yapabilir ! ! !');
   $this->redirect(['index']);
  }
    }

    /**
     * Finds the Yorum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Yorum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Yorum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

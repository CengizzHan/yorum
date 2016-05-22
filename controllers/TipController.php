<?php

namespace cengizzhan\yorum\controllers;

use Yii;
use cengizzhan\yorum\models\Tip;
use cengizzhan\yorum\models\Yorum;
use cengizzhan\yorum\models\TipSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * TipController implements the CRUD actions for Tip model.
 */
class TipController extends Controller
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
     * Lists all Tip models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tip model.
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
     * Creates a new Tip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->can('tipekle')) {
        $model = new Tip();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
		}else{
			Yii::$app->session->setFlash('error', 'Tip oluşturma yetkiniz yok');
			$this->redirect(['index']);
		}
    }

    /**
     * Updates an existing Tip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         if (Yii::$app->user->can('yorumguncelle')) {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
		}else{
			Yii::$app->session->setFlash('error', 'Sadece admin Tip güncelleyebilir!');
			$this->redirect(['index']);
		}
    }

    /**
     * Deletes an existing Tip model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	
		 if (Yii::$app->user->can('tipsil')) {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
		}
		 else{
   Yii::$app->session->setFlash('error', 'Sadece Yetkili Kullanıcı Silme İşlemi Yapabilir ! ! !');
   $this->redirect(['index']);
  }
    }

    /**
     * Finds the Tip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

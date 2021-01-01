<?php

namespace backend\controllers;

use Yii;
use common\models\WorkInProgress;
use backend\models\WorkInProgressSearch;
use common\models\WorkInProgressHistory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkInProgressController implements the CRUD actions for WorkInProgress model.
 */
class WorkInProgressController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WorkInProgress models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkInProgressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkInProgress model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $histories = WorkInProgressHistory::find(['wipId' => $id])->orderBy(['createdAt' => SORT_DESC])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'histories' => $histories
        ]);
    }

    /**
     * Creates a new WorkInProgress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WorkInProgress();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WorkInProgress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $history = new WorkInProgressHistory();
        $history->loadFromWIP($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(!$history->save()){
                var_dump($history->errors);die();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WorkInProgress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMarkAsCompleted($id)
    {
        $model = $this->findModel($id);
        $model->isActive = 0;
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionMarkAsActive($id)
    {
        $model = $this->findModel($id);
        $model->isActive = 1;
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the WorkInProgress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WorkInProgress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkInProgress::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\modules\placepractice\controllers;

use app\models\Placepractice;
use app\models\Group;
use app\models\PlacepracticeSearch;
use app\models\ViewPractice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Placepractice model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Placepractice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PlacepracticeSearch();
        $group = Group::getGroupList();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $view_practice = ViewPractice::getViewPracticeList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'group' => $group,
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Displays a single Placepractice model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $view_practice = ViewPractice::getViewPracticeList();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Creates a new Placepractice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Placepractice();
        $group = Group::getGroupList();
        $view_practice = ViewPractice::getViewPracticeList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'group' => $group,
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Updates an existing Placepractice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $group = Group::getGroupList();
        $view_practice = ViewPractice::getViewPracticeList();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'group' => $group,
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Deletes an existing Placepractice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Placepractice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Placepractice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Placepractice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\modules\documents\controllers;

use app\models\Documents;
use app\models\DocumentsSearch;
use app\models\ViewPractice;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use Yii;
use yii\helpers\VarDumper;

/**
 * DefaultController implements the CRUD actions for Documents model.
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
     * Lists all Documents models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $view_practice = ViewPractice::getViewPracticeList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Displays a single Documents model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Documents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Documents();
        $view_practice = ViewPractice::getViewPracticeList();

        if ($this->request->isPost) {
            //foreach( $model->getFileNames() as $fileName => $fieldName ) {
                if ($model->load($this->request->post())) {
                    $model->files = UploadedFile::getInstances($model, 'files');
                    if($model->upload()) {
                        if($model->save(false)){
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                   // VarDumper::dump($model, 10, true);die;
                }
            //}

        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Updates an existing Documents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $view_practice = ViewPractice::getViewPracticeList();

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            foreach( $model->getFileNames() as $fileName => $fieldName ) {
                $model->$fileName = UploadedFile::getInstances($model, $fileName);
            }
            if($model->upload()) {
                if($model->save(false)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'view_practice' => $view_practice,
        ]);
    }

    /**
     * Deletes an existing Documents model.
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
     * Finds the Documents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Documents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documents::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @throws Exception
     */
}

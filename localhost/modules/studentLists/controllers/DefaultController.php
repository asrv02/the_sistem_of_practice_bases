<?php

namespace app\modules\studentLists\controllers;

use app\models\StudentLists;
use app\models\StudentListsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Application;
use app\models\EmployerLists;
use app\models\Specialization;

use app\models\Status;
use Yii;


/**
 * DefaultController implements the CRUD actions for StudentLists model.
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
     * Lists all StudentLists models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentListsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // $studentLists = StudentLists::getStudentLists();
        $specializations = Specialization::getSpecializationList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'specializations' => $specializations,
            // 'studentLists' => $studentLists,
        ]);
    }

    /**
     * Displays a single StudentLists model.
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
     * Creates a new StudentLists model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StudentLists();
        // $studentLists = StudentLists::getStudentLists();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            // 'studentLists' => $studentLists,
        ]);
    }

    /**
     * Updates an existing StudentLists model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $studentLists = StudentLists::getStudentLists();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            // 'studentLists' => $studentLists,
        ]);
    }

    /**
     * Deletes an existing StudentLists model.
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
     * Finds the StudentLists model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return StudentLists the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentLists::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMove($id)
    {
        $studentListsItem = $this->findModel($id);

        $emplist = EmployerLists::findOne(['employer_id' => Yii::$app->user->identity->id]);

        $application = new Application();
        $application->organization_name_id = $emplist->information->organization_name_id;
        $application->student_id = $studentListsItem->student_id;
        $application->student_lists_id = $studentListsItem->id;
        $application->status_id = Status::STATUS_ACTIVE;
        $application->employer_id = Yii::$app->user->identity->id;
        $application->save();
        return $this->redirect(['index']);
    }
}

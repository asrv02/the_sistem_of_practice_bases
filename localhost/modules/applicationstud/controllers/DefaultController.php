<?php

namespace app\modules\applicationstud\controllers;

use app\models\Applicationstud;
use app\models\ApplicationstudSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Status;
use app\models\User;
use app\models\Specialization;
use app\models\OrganizationName;
use Yii;

/**
 * DefaultController implements the CRUD actions for Applicationstud model.
 */
class DefaultController extends Controller
{

    public function beforeAction($action)
    {
        if ( \Yii::$app->user->can('admin') )
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return parent::beforeAction($action);
    }

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
     * Lists all Applicationstud models.
     *
     * @return string
     */
    public function actionIndex()
    {


        if ( \Yii::$app->user->can('student') ) {
            $searchModel = new ApplicationstudSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->query->where(['student_id' => Yii::$app->user->id]);
            $status = Status::getStatusList();
            $specialization = Specialization::getSpecializationList();
            $organizationName = OrganizationName::getOrganizationNameList();
            return $this->render('for_student', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'status' => $status,
                'specialization' => $specialization,
                'organizationName' => $organizationName,

            ]);
        } else {
            $searchModel = new ApplicationstudSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $dataProvider->query->where(['employer_id' => Yii::$app->user->id]);
            $status = Status::getStatusList();
            $specialization = Specialization::getSpecializationList();
            $organizationName = OrganizationName::getOrganizationNameList();
            return $this->render('for_employer', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'status' => $status,
                'specialization' => $specialization,
                'organizationName' => $organizationName,

            ]);
        }
        
    }

    /**
     * Displays a single Applicationstud model.
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
     * Creates a new Applicationstud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Applicationstud();
        $organizationName = OrganizationName::getOrganizationNameList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'organizationName' => $organizationName,
        ]);
    }

    /**
     * Updates an existing Applicationstud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'organizationName' => $organizationName,
        ]);
    }

    /**
     * Deletes an existing Applicationstud model.
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
     * Finds the Applicationstud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Applicationstud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Applicationstud::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionApprove_employer($id) {
        $model = $this->findModel($id);
        if ( $model ) {
            $model->status_id = Status::STATUS_APPROVED;
            $model->save();
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
    public function actionDecline_employer($id) {
        $model = $this->findModel($id);
        if ( $model ) {
            $model->status_id = Status::STATUS_DECLINE;
            $model->save();
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
}

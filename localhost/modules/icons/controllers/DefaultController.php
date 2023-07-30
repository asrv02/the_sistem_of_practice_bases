<?php

namespace app\modules\icons\controllers;

use app\models\Resume;
use app\models\ResumeSearch;
use app\models\StudentResume;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl; 
use app\models\Specialization;
use app\models\EducationReceived;
use app\models\EducationalInstitution;
use app\models\TrainingForm;
use Symfony\Component\VarDumper\VarDumper;
use yii\bootstrap5\ActiveForm;
use Yii;

/**
 * ResumeController implements the CRUD actions for Resume model.
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
     * Lists all Resume models.
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $trainingForm = TrainingForm::getTrainingFormList();
        $educationalInstitution = EducationalInstitution::getEducationalInstitutionList();
        $educationReceived = EducationReceived::getEducationReceivedList();
        $specialization = Specialization::getSpecializationList();
        $model = Resume::find()
            ->joinWith('studentResume')
            ->where(['student_id' => Yii::$app->user->id])->one();
        if ($this->request->isPost) {
            if (!$model) {
                $model = new Resume();
            }
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'specialization' => $specialization,
                    'trainingForm' => $trainingForm,
                    'educationalInstitution' => $educationalInstitution,
                    'educationReceived' => $educationReceived,
                ]);
            }
        } else {
            if (!$model) {
                $model = new Resume();
                $model->loadDefaultValues();
                return $this->render('create', [
                    'model' => $model,
                    'specialization' => $specialization,
                    'trainingForm' => $trainingForm,
                    'educationalInstitution' => $educationalInstitution,
                    'educationReceived' => $educationReceived,
                ]);
            } else {
                return $this->render('view', [
                    'model' => $model,
                    'specialization' => $specialization,
                    'trainingForm' => $trainingForm,
                    'educationalInstitution' => $educationalInstitution,
                    'educationReceived' => $educationReceived,
                    
                ]);
            }
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Resume();
        $trainingForm = TrainingForm::getTrainingFormList();
        $educationalInstitution = EducationalInstitution::getEducationalInstitutionList();
        $educationReceived = EducationReceived::getEducationReceivedList();
        $specialization = Specialization::getSpecializationList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'specialization' => $specialization,
            'trainingForm' => $trainingForm,
            'educationalInstitution' => $educationalInstitution,
            'educationReceived' => $educationReceived,
        ]);
    }

    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $specialization = Specialization::getSpecializationList();
        $educationalInstitution = EducationalInstitution::getEducationalInstitutionList();
        $educationReceived = EducationReceived::getEducationReceivedList();
        $trainingForm = TrainingForm::getTrainingFormList();
        $model = Resume::find()
            ->joinWith('studentResume')
            ->where(['student_id' => Yii::$app->user->id])->one();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'specialization' => $specialization,
            'trainingForm' => $trainingForm,
            'educationalInstitution' => $educationalInstitution,
            'educationReceived' => $educationReceived,
        ]);
    }

    /**
     * Deletes an existing Resume model.
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
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



}

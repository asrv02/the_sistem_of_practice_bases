<?php

namespace app\modules\userInterprise\controllers;

use app\models\Application;
use app\models\Status;
use app\models\StudentLists;
use app\models\User;
use app\models\UserInterprise;
use app\models\UserInterpriseSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * DefaultController implements the CRUD actions for UserInterprise model.
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
     * Lists all UserInterprise models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserInterpriseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserInterprise model.
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
     * Updates an existing UserInterprise model.
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
        ]);
    }

    /**
     * Deletes an existing UserInterprise model.
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
     * Finds the UserInterprise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserInterprise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserInterprise::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMove($id)
    {
        $userInterprise = $this->findModel($id);

        //$emplist = UserInterprise::findOne(['user_id' => Yii::$app->user->identity->id]);

        $application = new Application();
        $application->organization_id = $userInterprise->organization_id;
        $application->student_id = Yii::$app->user->identity->id;
        // $application->student_lists_id = StudentLists::findOne(Yii::$app->user->identity->id)->id;
        $application->status_id = Status::STATUS_ACTIVE;
        $application->employer_id = $userInterprise->user_id;
        $application->save();

       // VarDumper::dump($application, 10, true);die;

        return $this->redirect(['index']);
    }
}

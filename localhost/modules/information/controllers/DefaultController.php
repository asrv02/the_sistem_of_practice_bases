<?php

namespace app\modules\information\controllers;

use app\models\Information;
use app\models\OrganizationName;
use app\models\EmployerLists;
use app\models\InformationSearch;
use app\models\EmployerInformation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * InformationController implements the CRUD actions for Information model.
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
                // 'access' => [
                //     'class' => AccessControl::class,
                //     'rules' => [
                //         [
                //             'actions' => ['logout'],
                //             'allow' => true,
                //             'roles' => ['per_employer'],
                //         ],
                //     ],
                // ],
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
     * Lists all Information models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $specializations = Specialization::getSpecializationList();
        $organization_name = OrganizationName::getOrganizationName();
        $model = Information::find()
            ->joinWith('organization')
            ->where(['employer_id' => Yii::$app->user->id])->one();
        if ($this->request->isPost) {
            if (!$model) {
                $model = new Information();
            }
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'organization_name' => $organization_name,
                ]);
            }
        } else {
            if (!$model) {
                $model = new Information();
                $model->loadDefaultValues();
                return $this->render('create', [
                    'model' => $model,
                    'organization_name' => $organization_name,
                ]);
            } else {
                return $this->render('view', [
                    'model' => $model,
                    'organization_name' => $organization_name,
                ]);
            }
        }
    }

    /**
     * Displays a single Information model.
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
     * Creates a new Information model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Information();
        $organization_name = OrganizationName::getOrganizationName();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'organization_name' => $organization_name,
        ]);
    }

    /**
     * Updates an existing Information model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $organization_name = OrganizationName::getOrganizationName();
        $model = Information::find()
            ->joinWith('organization')
            ->where(['employer_id' => Yii::$app->user->id])->one();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'organization_name' => $organization_name,
        ]);
    }


    /**
     * Deletes an existing Information model.
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
     * Finds the Information model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Information the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Information::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMove($id)
    {
        $information = $this->findModel($id);
        $model = EmployerLists::find()
                                ->where(['employer_id'=>Yii::$app->user->id, 'information_id'=>$information->id])
                                ->one();
        if($model) {
            return $this->redirect(['index']);
        }
        // VarDumper::dump($cart, 10, true);
        // die;
        $employerLists = new EmployerLists();
        $employerLists->employer_id = Yii::$app->user->id;
        // TODO: получать специализацию из студента
        $employerLists->information_id = $information->id;

        $employerLists->save();
        return $this->redirect(['index']);
    }
}

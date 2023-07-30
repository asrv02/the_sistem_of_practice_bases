<?php

namespace app\modules\studentToList\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\Group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use app\models\StudentLists;
use app\models\Specialization;
use app\models\StudentGroup;

/**
 * DefaultController implements the CRUD actions for User model.
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $group = Group::getGroupList();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $specialization = Specialization::getSpecializationList();
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'group' => $group,
            'specialization' => $specialization,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $group_id)
    {
        $model_st_gr = StudentGroup::find()->where(['student_id' => $id, 'group_id' => $group_id])->orderBy('id desc')->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'group' => Group::getGroupList(),
            'model_st_gr' =>  $model_st_gr,
            'group' => Group::getGroupList(),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $group = Group::getGroupList();
        $specialization = Specialization::getSpecializationList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                if( $model->save() ) {
                    if( !($st_gr = StudentGroup::findOne(['student_id' => $model->id, 'group_id' => $model->group_id])) ) {
                        $st_gr = new StudentGroup();
                        $st_gr->student_id = $model->id;
                        $st_gr->group_id = $model->group_id;
                        $st_gr->save();                       
                    }

                    
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('student');
                    $auth->assign($authorRole, $model->id);

                    return $this->redirect(['view', 'id' => $model->id, 'group_id' => $model->group_id]);
                }  else {
                    VarDumper::dump($model->errors, 10, true); die;
                } 
                        
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'group' => $group,
            'specialization' => $specialization,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $group = Group::getGroupList();
        $specialization = Specialization::getSpecializationList();
        $model_st_gr = StudentGroup::find()->select('group_id')->where(['student_id' => $id])->orderBy('id desc')->one();
        if( $model_st_gr ) {
            $model->group_id = $model_st_gr->group_id;
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);

            if( $model->save() ) {
                $model_st_gr = StudentGroup::find()->where(['student_id' => $id])->orderBy('id desc')->one();
                if( !$model_st_gr ) {                
                    $model_st_gr = new StudentGroup();
                    $model_st_gr->student_id = $model->id;
                }
                
                $model_st_gr->group_id =  $model->group_id;
                $model_st_gr->save();
                return $this->redirect(['view', 'id' => $model->id, 'group_id' => $model->group_id]);
            }
            
            
        }

        $model->password = null;
        return $this->render('update', [
            'model' => $model,
            'group' => $group,
            'specialization' => $specialization,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMove($id)
    {
        if ( !$this->request->isPost ) {
            throw new NotFoundHttpException('The requested page does not exist.'); 
        }
        $user = $this->findModel($id);
        $dateTo = $this->request->post('date_to');
        $dateFrom = $this->request->post('date_from');
        if ( !$user || !$dateTo || !$dateFrom ) {
            Yii::$app->session->setFlash('error', 'Отсутвуют обязательные данные или пользователь не найден!');
            return $this->redirect(['index']);
        }

        $studentList = new StudentLists();
        $studentList->student_id = $user->id;
        // TODO: получать специализацию из студента
        $studentList->specialization_id =  4;
        $studentList->practice_date_to = date('Y-m-d', \DateTime::createFromFormat('d.m.Y', $dateTo)->getTimestamp());
        $studentList->practice_date_from = date('Y-m-d', \DateTime::createFromFormat('d.m.Y', $dateFrom)->getTimestamp());
        $studentList->save();

        return $this->redirect(['index']);
    }
}

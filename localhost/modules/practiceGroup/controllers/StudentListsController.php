<?php

namespace app\modules\practiceGroup\controllers;

use app\models\PracticeGroup;
use app\models\PracticeGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Group;
use app\models\Organization;
use app\models\PlaceEnterprises;
use app\models\StudentLists;
use app\models\StudentPractice;
use app\models\StudentPracticeSearch;
use app\models\User;
use app\models\ViewPractice;
use Yii;
use yii\helpers\VarDumper;

/**
 * DefaultController implements the CRUD actions for PracticeGroup model.
 */
class StudentListsController extends Controller
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


    public function beforeAction($action)
    {     
        switch($action->id) {
            case 'modal-load':


                $this->enableCsrfValidation = false;
        }
        
        return parent::beforeAction($action);
    }

    /**
     * Lists all PracticeGroup models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PracticeGroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $group = Group::getGroupList();
        $viewPractice = ViewPractice::getViewPracticeList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'group' => $group,
            'viewPractice' => $viewPractice,
        ]);
    }

    /**
     * Displays a single PracticeGroup model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($group_id,$practice_group_id)
    {
        // var_dump($id_group,$id_practic);  die;
       if( !StudentPractice::getStudentPracticCount($group_id,$practice_group_id) ) {
            StudentPractice::addStudentPracticGroup($group_id,$practice_group_id);
       }
       $searchModel = new StudentPracticeSearch();
       $dataProvider = $searchModel->search($this->request->queryParams);
    //    $group = Group::getGroupList();
       $viewPractice = ViewPractice::getViewPracticeList();
       $organization = Organization::getOrganization();

       return $this->render('view', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
        //    'group' => $group,
           'viewPractice' => $viewPractice,
           'organization' => $organization,           
           'practice_group_id' => $practice_group_id,
           'id_group' => $group_id,

       ]);

        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    public function actionModalLoad()
    {
        $id_practice_group = Yii::$app->request->post('practice_group_id');
        $student_practice_id = Yii::$app->request->post('student_practice_id');
        $viewPractice = ViewPractice::getViewPracticeList();

        if( $model = PracticeGroup::findOne($id_practice_group) ) {
            $organization = Organization::getOrganization();
           
            return $this->renderAjax('modal-practice', compact('model', 'organization', 'id_practice_group', 'student_practice_id', 'viewPractice'));
        }      
    }

    

    public function actionSet($id)
    {
        if( Yii::$app->request->isPost) {
            if( ($model = StudentPractice::findOne($id)) &&  $model->load(Yii::$app->request->post()) ) {
                // VarDumper::dump($model->attributes, 10, true); die;


                if( (!empty($model->organization_id) || !empty($model->place_title)) 
                    && !(!empty($model->organization_id) && !empty($model->place_title)) ) {
                    $query = 'update student_practice '
                            . "set "
                            . (empty($model->organization_id) ? 'place_title' : 'organization_id') . " = "
                            . (empty($model->organization_id) ? "'{$model->place_title}'" : $model->organization_id)
                            . (empty($model->place_title) ? ', place_title = NULL' : '')    
                            . ' where '
                            . "id = {$model->id} "
                        ;
                
                    $num = Yii::$app->db->createCommand($query)->execute();
                }
                
                return $this->redirect(['view', 'id_group' => $model->practiceGroup->group->id, 'id_practice_group' => $model->practice_group_id]);
            }
        } else {
           
            // $organization = Organization::getOrganization();
            // $model = StudentPractice::findOne($id);
            // return $this->renderAjax('modal', compact('model', 'organization'));
        }
    }

    public function actionPracticeSend()
    {
        $student_practice_id = json_decode(Yii::$app->request->post('student_practice_id'));        
        $id_org = Yii::$app->request->post('id_org');
        $place_practice = Yii::$app->request->post('place_practice');
        $res = true;

        if( $student_practice_id  && ($id_org || $place_practice) ) {
            foreach($student_practice_id as $id) {
                if( $model = StudentPractice::findOne($id) ) {
                    $query = 'update student_practice '
                                . "set "
                                . 'organization_id = ' . (empty($id_org) ? 'null' : $id_org) . ','
                                . 'place_title = ' . (empty($place_practice) ? 'null' : "'{$place_practice}'")
                                . ' where '
                                . "id = {$model->id} "
                                ;
        
                    $res &= Yii::$app->db->createCommand($query)->execute(); 
                } else {
                    $res = false;
                }
            } 
        } else {
            $res = false;
        }
        
        return $res;
    }

    public function actionSetStudentsSelect()
    {
        if( Yii::$app->request->isPost && Yii::$app->request->isAjax ) {

            // if( ($model = StudentPractice::findOne($id)) &&  $model->load(Yii::$app->request->post()) ) {
            //     // VarDumper::dump($model->attributes, 10, true); die;


            //     if( (!empty($model->organization_id) || !empty($model->place_title)) 
            //         && !(!empty($model->organization_id) && !empty($model->place_title)) ) {
            //         $query = 'update student_practice '
            //                 . "set "
            //                 . (empty($model->organization_id) ? 'place_title' : 'organization_id') . " = "
            //                 . (empty($model->organization_id) ? "'{$model->place_title}'" : $model->organization_id)
            //                 . (empty($model->place_title) ? ', place_title = NULL' : '')    
            //                 . ' where '
            //                 . "id = {$model->id} "
            //             ;
                
            //         $num = Yii::$app->db->createCommand($query)->execute();
            //     }
            // }
        } else {
            $organization = Organization::getOrganization();
            if( $model = StudentPractice::findOne(Yii::$app->request->get('student_practice_id')) )
                return $this->renderAjax('modal-group', compact('model', 'organization'));
            else 
                return $this->asJson(false);    
        }
    }

    /**
     * Creates a new PracticeGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PracticeGroup();
        $group = Group::getGroupList();
        $viewPractice = ViewPractice::getViewPracticeList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                //


                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'group' => $group,
            'viewPractice' => $viewPractice,
        ]);
    }

    /**
     * Updates an existing PracticeGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $group = Group::getGroupList();
        $viewPractice = ViewPractice::getViewPracticeList();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'group' => $group,
            'viewPractice' => $viewPractice,
        ]);
    }

    /**
     * Deletes an existing PracticeGroup model.
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
     * Finds the PracticeGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PracticeGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PracticeGroup::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
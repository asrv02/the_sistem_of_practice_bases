<?php

namespace app\modules\practiceGroup\controllers;

use app\models\Documents;
use app\models\PracticeGroup;
use app\models\PracticeGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Group;
use app\models\Organization;
use app\models\PlaceEnterprises;
use app\models\StatusLoading;
use app\models\StudentPractice;
use app\models\ViewPractice;
use PhpOffice\PhpWord\Reader\RTF\Document;
use Yii;
use yii\helpers\VarDumper;

/**
 * DefaultController implements the CRUD actions for PracticeGroup model.
 */
class MainController extends Controller
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
        $organization = Organization::getOrganization();
        $status_loading = StatusLoading::getStatusLoading();
        $documents = Documents::getDocumentsList();
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'group' => $group,
            'viewPractice' => $viewPractice,
            'organization' => $organization,
            'status_loading' => $status_loading,
            'documents' => $documents,
        ]);
    }

    /**
     * Displays a single PracticeGroup model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $viewPractice = ViewPractice::getViewPracticeList();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'viewPractice' => $viewPractice,
        ]);
    }

    public function actionDownload($url)
    {
        $downloadFile =  Yii::getAlias('@app') . '/web' .$url;
        // // Контент-тип означающий скачивание
        header("Content-Type: application/octet-stream");

        // // Размер в байтах
        header("Accept-Ranges: bytes");
        
        // // Размер файла
        header("Content-Length: ".filesize($downloadFile));
        
        // // Расположение скачиваемого файла
        header("Content-Disposition: attachment; filename=".$downloadFile);  
        
        // // Прочитать файл
        readfile($downloadFile);
        
        
        // unlink($uploadFile);
        // unlink($outputFile);

        return $this->redirect('index');
    }


    public function actionSet($id)
    {
        if( Yii::$app->request->isPost) {
            if( ($model = PracticeGroup::findOne($id)) &&  ($model->load(Yii::$app->request->post())) ) {
                if( !StudentPractice::getStudentPracticCount($model->group_id,$model->id) ) {
                    StudentPractice::addStudentPracticGroup($model->group_id,$model->id);
                }

                $query = 'update student_practice '
                            . "set organization_id = {$model->organization_id} "      
                            . 'where '
                            . "practice_group_id = {$model->id} "
                            . "and (place_title is null or length(trim(place_title)) = 0) "
                            . 'and organization_id is null'
                        ;
                
                if( Yii::$app->db->createCommand($query)->execute() ) {
                    return $this->redirect('index');
                }
                
            }
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
        $status_loading = StatusLoading::getStatusLoading();
        $documents = Documents::getDocumentsList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                //
                if( !StudentPractice::getStudentPracticCount($model->group_id,$model->id) ) {
                    StudentPractice::addStudentPracticGroup($model->group_id,$model->id);
                }

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        
        //VarDumper::dump($model, 10, true);die;

        return $this->render('create', [
            'model' => $model,
            'group' => $group,
            'viewPractice' => $viewPractice,
            'status_loading' => $status_loading,
            'documents' => $documents,
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
        $status_loading = StatusLoading::getStatusLoading();
        $documents = Documents::getDocumentsList();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'group' => $group,
            'viewPractice' => $viewPractice,
            'status_loading' => $status_loading,
            'documents' => $documents,
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

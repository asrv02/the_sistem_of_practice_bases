<?php

namespace app\modules\studentProfile\controllers;

use app\models\Documents;
use app\models\Organization;
use app\models\StudentPractice;
use app\models\StudentPracticeSearch;
use app\models\UploadForm;
use app\models\ViewPractice;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * DefaultController implements the CRUD actions for StudentPractice model.
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
     * Lists all StudentPractice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentPracticeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $organization = Organization::getOrganization();
        $view_practice = ViewPractice::getViewPracticeList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'organization' => $organization,
            'view_practice' => $view_practice,
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
        header("Content-Disposition: attachment; filename=" . $downloadFile);  
        
        // // Прочитать файл
        readfile($downloadFile);
        
        
        // unlink($uploadFile);
        // unlink($outputFile);

        return $this->redirect('index');
    }


    public function actionDownloadReport($url, $id) 
    {
        $downloadFile =  Yii::getAlias('@app') . '/web' . $url;
        if($model = $this->findModel($id) ) {
             // var_dump($downloadFile, file_exists($downloadFile)); die;
            $headers = Yii::$app->response->headers;
            $headers->add('Pragma', 'no-cache');
            $headers->add('Content-Type', 'text/docx');
            $headers->add('Content-Description', 'File Transfer');
            $headers->add('Content-Transfer-Encoding', 'binary');
            $headers->add('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
            $headers->add('Content-Disposition','attachment; filename=' . $model->report);
            return Yii::$app->response->SendFile($downloadFile);
        }
       
    }


    /**
     * Displays a single StudentPractice model.
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
    public function actionCreate($id)
    {
        $model = new UploadForm();
        
        if ($this->request->isPost) {
          
            if ($model->load($this->request->post())) {
                
                $model->reportFile = UploadedFile::getInstance($model, 'reportFile');
                
                if( $fileName = $model->upload() ) {    
                    
                    if( $model = StudentPractice::findOne($id) ){
                        
                        $model->report = 'uploads/' . $fileName;
                        $model->save(false);                        
                        return $this->redirect(['index']);
                    }
                }
            }
        }        
        // } else {
        //     $model->loadDefaultValues();
        // }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StudentPractice model.
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
     * Deletes an existing StudentPractice model.
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
     * Finds the StudentPractice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return StudentPractice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentPractice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


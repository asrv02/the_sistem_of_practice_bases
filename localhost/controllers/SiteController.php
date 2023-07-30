<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Organization;
use app\models\PlaceEnterprises;
use app\models\Post;
use app\models\RegisterForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\VarDumper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        $organization = Organization::getOrganization();
        $post = Post::getPostTitle();

        // VarDumper::dump($post, 10, true); die;


        if ($model->load(Yii::$app->request->post())){
            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if($user = $model->registerUser()){
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('register', [
            'model' => $model,
            'organization' => $organization,
            'post' => $post,
        ]);
    }

    public function actionWord()
    {
        return $this->render('word');
    }

    public function actionWordSave()
    {
        $filename = Yii::getAlias('@app') . '/web/docx/review.docx';
        $document = new \PhpOffice\PhpWord\TemplateProcessor($filename);

        $uploadDir =  __DIR__;
        $outputFile = Yii::getAlias('@app') . '/web/docx/review_full.docx';
        
        //VarDumper::dump($_POST, 10, true);die;
        
        // $uploadFile = $uploadDir . '\\' . basename($_FILES['file']['name']);
        // move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
        
        // $birthdate = $_POST['birth'];
        $name = $_POST['name'];
        $value_1 = $_POST['value_1'];
        $value_2 = $_POST['value_2'];
        $value_3 = $_POST['value_3'];
        $value_4 = $_POST['value_4'];
        $value_5 = $_POST['value_5'];
        $value_6 = $_POST['value_6'];
        $value_7 = $_POST['value_7'];
        $value_8 = $_POST['value_8'];
        $value_9 = $_POST['value_9'];
        $value_10 = $_POST['value_10'];
        $value_11 = $_POST['value_11'];
        $value_12 = $_POST['value_12'];
        $value_13 = $_POST['value_13'];
        $value_14 = $_POST['value_14'];
        $value_15 = $_POST['value_15'];
        $grading_general = $_POST['grading_general'];
        //$file = $_POST['file'];
        // $about = $_POST['about'];
        
        $document->setValue('name', $name);
        // $document->setValue('birthdate', $birthdate);
        $document->setValue('value_1', $value_1);
        $document->setValue('value_2', $value_2);
        $document->setValue('value_3', $value_3);
        $document->setValue('value_4', $value_4);
        $document->setValue('value_5', $value_5);
        $document->setValue('value_6', $value_6);
        $document->setValue('value_7', $value_7);
        $document->setValue('value_8', $value_8);
        $document->setValue('value_9', $value_9);
        $document->setValue('value_10', $value_10);
        $document->setValue('value_11', $value_11);
        $document->setValue('value_12', $value_12);
        $document->setValue('value_13', $value_13);
        $document->setValue('value_14', $value_14);
        $document->setValue('value_15', $value_15);
        $document->setValue('grading_general', $grading_general);
        // $document->setImageValue('image', array('path' => $uploadFile, 'width' => 120, 'height' => 120, 'ratio' => false));
        
        $document->saveAs($outputFile);
        
        
        // Имя скачиваемого файла
        $downloadFile = $outputFile;
        
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

        return $this->redirect('word');
    }


}

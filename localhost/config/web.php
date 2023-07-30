<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'defaultRoute' => 'site/about',
    'layout' => 'blog',
    'name' => 'Diplom',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
         'assetManager' => [
        'bundles' => [
            'kartik\form\ActiveFormAsset' => [
                'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
            ],
        ],
    ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rter',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'keyPrefix' => 'myapp',
        ],
        
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        /*'charts' => [
            'class' => 'app\modules\charts\Module',
        ],*/
        'forms' => [
            'class' => 'app\modules\forms\Module',
        ],
        'icons' => [
            'class' => 'app\modules\icons\Module',
        ],
        /*'tables' => [
            'class' => 'app\modules\tables\Module',
        ],*/
        'specialization' => [
            'class' => 'app\modules\specialization\Module',
        ],
        'information' => [
            'class' => 'app\modules\information\Module',
        ],
        'entry' => [
            'class' => 'app\modules\entry\Module',
        ],
        'application' => [
            'class' => 'app\modules\application\Module',
        ],
        'employer-lists' => [
            'class' => 'app\modules\employerLists\Module',
        ],
        'student-lists' => [
            'class' => 'app\modules\studentLists\Module',
        ],
        'student-to-list' => [
            'class' => 'app\modules\studentToList\Module',
        ],
        'applicationstud' => [
            'class' => 'app\modules\applicationstud\Module',
        ],
        'placepractice' => [
            'class' => 'app\modules\placepractice\Module',
        ],
        'documents' => [
            'class' => 'app\modules\documents\Module',
        ],
        'practice-group' => [
            'class' => 'app\modules\practiceGroup\Module',
            'defaultRoute' => 'main/index'
        ],
        'student-profile' => [
            'class' => 'app\modules\studentProfile\Module',
        ],
        'place-enterprises' => [
            'class' => 'app\modules\placeEnterprises\Module',
        ],
        'organization' => [
            'class' => 'app\modules\organization\Module',
        ],
        'user-interprise' => [
            'class' => 'app\modules\userInterprise\Module',
        ],
        'post' => [
            'class' => 'app\modules\post\Module',
        ],

    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;

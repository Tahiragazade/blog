<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser', // unique for backend
            ]
        ],
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '[burda nese var]',
            'csrfParam' => '_backendCSRF',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'logging'=>[
            'class'=>'backend\components\Logging',
        ],
        

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
         'authManager'=>[
        'class'=>'yii\rbac\DbManager',
        'defaultRoles'=>['guest'],
    ],
    'assetManager' => [
        'bundles' => [
            'kartik\form\ActiveFormAsset' => [
                'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
            ],
        ],
    ],
    ],
    //'loging'=>
    //    [
    //        'class' => 'yii\components\loging',
    //    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
         ],

    'params' => $params,
    //'modules' => [
   //'gridview' =>  [
   //     'class' => '\kartik\grid\Module',
   //     // your other grid module settings
   // ],
   //'gridviewKrajee' =>  [
   //     'class' => '\kartik\grid\Module',
        // your other grid module settings
   // ]
    //],
    
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl'=>'@backend/web',
                    'basePath'=>'uploads',
                    'path' => '/',
                    'name' => 'Global'
                ],
                
            ],
            
        ]
    ],
];

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
  /* 'controllerMap' => [
        'batch' => [
            'class' => '@vendor\schmunk42\giiant\commands\BatchController',
            'overwrite' => true,
            'modelNamespace' => 'app\\modules\\crud\\models',
            'modelQueryNamespace' => 'app\\modules\\crud\\models\\query',
            'crudControllerNamespace' => 'app\\modules\\crud\\controllers',
            'crudSearchModelNamespace' => 'app\\modules\\crud\\models\\search',
            'crudViewPath' => '@app/modules/crud/views',
            'crudPathPrefix' => '/crud/',
            'crudTidyOutput' => true,
            'crudAccessFilter' => true,
            'crudProviders' => [
                '@vender\schmunk42\\giiant\\generators\\crud\\providers\\optsProvider',
            ],
            'tablePrefix' => 'app_',
            'tables' => [
                'app_profile',
            ]
        ]
    ], */   
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'view' => [
             'theme' => [
                 'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                 ],
             ],
        ],
        'assetManager' => [
            'bundles' => [
                '@vender\dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red',
                ],
            ],
        ],     
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
    ],
    'params' => $params,
];

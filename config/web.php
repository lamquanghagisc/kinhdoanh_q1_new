<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'main',
    'language' => 'vi-VN',
//    'defaultRoute' => 'cms/auth-user',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ]
            ],
            //'appendTimestamp' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'o60lq8tkQdSpe0YVVgspsSNPn-jIuk1q1',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\cms\models\AuthUser',
            // 'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'htmlLayout' => 'layouts/main-html',
            'textLayout' => 'layouts/main-text',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['hcmgis.dost@gmail.com' => 'HCMGIS Quận/Huyện'],
            ],
            'useFileTransport' => false,
            'transport' => [
                // 'class' => 'Swift_SmtpTransport',
                // 'host' => 'host07.emailserver.vn',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                // 'username' => 'loitn@hcmgis.vn',
                // 'password' => 'loitnHCMGIS',
                // 'port' => '465', // Port 25 is a very common port too
                // 'encryption' => 'ssl', // It is often used, check your provider or mail server specs
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'truongan361987@gmail.com',
                'password' => 'Truongan@1987',
                'port' => '465', // Port 25 is a very common port too
                'encryption' => 'ssl', // It is often used, check your provider or mail server specs
            ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/user', 'api/group'],
                    'extraPatterns' => [
                        'GET user-info' => 'user-info',
                    ],
                ],
            ],
        ],
        'db' => $db,
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                // 'facebook' => [
                //     //Nam Trần
                //     'class' => 'yii\authclient\clients\Facebook',
                //     'clientId' => '659731548199791',
                //     'clientSecret' => '1a96cbc0d9cb729fa3f6d6c2556b2889',
                // ],
                'google' => [
                    //hcmgis.dost@gmail.com
                    'class'        => 'yii\authclient\clients\Google',
                    'clientId'     => '809492221306-1h41l99o5bkgqr4mpvnq4fbbhus1ruba.apps.googleusercontent.com',
                    'clientSecret' => 'LQLtPl3RtvMJGohLU0N6LCZF',
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd/mm/yyyy',
            'datetimeFormat' => 'php:d/m/Y, H:i:s',
            ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'o60lq8tkQdSpe0YVVgspsSNPn',  //typically a long random string
            'jwtValidationData' => app\modules\auth\JwtValidationData::class,
        ],
    ],
    'params' => $params,
    'modules' => [
        'contrib' => [
            'class' => 'app\modules\contrib\Module'
        ],
        'cms' => [
            'class' => 'app\modules\cms\Module'
        ],
        'api' => [
            'class' => 'app\modules\api\Module'
        ],
        'qldanhmuc' => [
            'class' => 'app\modules\qldanhmuc\Module'
        ],
        'quanly' => [
            'class' => 'app\modules\quanly\Module'
        ],
        'auth' => [
            'class' => 'app\modules\auth\Module',
            'actionModules' => [ 'auth','quanly', 'qldanhmuc']
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
            'bsVersion' => '4'
        ]
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    // $config['modules']['gii'] = [
    //     'class' => 'yii\gii\Module',
    //     'generators' => [
    //         'crud2' => [
    //             'class' => 'app\modules\contrib\gii\crud\Generator', // generator class
    //         ]
    //     ],
    //     // uncomment the following to add your IP if you are not connecting from localhost.
    //     //'allowedIPs' => ['127.0.0.1', '::1'],
    // ];
	
	 $config['modules']['gridview'] = [
        'class' => 'app\widgets\gridview\Module',
        'bsVersion' => '4'
    ];
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
        'generators' => [
            'DCrud' => [
                'class' => 'app\widgets\crud\generators\Generator',
                //                'templates' => [
                //                    'my' => '@app/myTemplates/crud/default',
                //                ]
            ]
        ],
    ];

}


return $config;

<?php

/**
 * Description of Module
 *
 * @author admin
 */

namespace app\modules\api;

use app\modules\auth\services\AuthService;
use yii\filters\AccessControl;
use yii\web\ErrorHandler;
use yii\web\Response;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;

        \Yii::configure($this, [
            'components' => [
                'response' => [
                    'class' => 'yii\web\Response',
                    'on beforeSend' => function ($event) {
                        $response = $event->sender;
                        $response->format = Response::FORMAT_JSON;
                        if ($response->data !== null && $response->statusCode != 200) {
                            $response->data = [
                                'success' => $response->isSuccessful,
                                'data' => $response->data,
                                'message' => $response->data['message']
                            ];
                        }
                    },
                    'format' =>  \yii\web\Response::FORMAT_JSON
                ],
                'errorHandler' => [
                    'class' => ErrorHandler::class,
                ]
            ],
        ]);


        /** @var ErrorHandler $handler */
        $handler = $this->get('errorHandler');
        \Yii::$app->set('errorHandler', $handler);
        $handler->register();

        $response = $this->get('response');
        \Yii::$app->set('response', $response);
    }

    public static function allowedDomains()
    {
        return [
            // '*',                        // star allows all domains
            'http://localhost',
            'http://localhost:8000',
            'http://opendata.hcmgis.vn',
            'https://opendata.hcmgis.vn',
            'http://new-opendata.hcmgis.vn'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return  [

            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => \yii\filters\Cors::class,
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],
            'authenticator' => [
                'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
                'except' => [
                    'auth/login',
                    'auth/refresh-token',
                    'auth/options',
                ],
                'auth' => [AuthService::class, 'loginFromToken'],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['api/user', 'api/auth', 'api/group'],
                    ],

                ],
            ]
        ];
    }
}

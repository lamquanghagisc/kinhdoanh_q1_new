<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 9/24/2021
 * Time: 9:55 PM
 */

namespace app\modules\base;


use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller
{
    public function actions()
    {
        $this->layout = '@app/views/layouts/modules/main';
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'index', 'create', 'update', 'delete', 'search', 'view', 'get-nocgia'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'get-nocgia'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'view', 'index', 'search', 'get-nocgia'],
                        'roles' => ['viewer'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'create', 'update', 'delete', 'search', 'view', 'index', 'get-nocgia'],
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
//                    $queryParams = \Yii::$app->request->queryParams;
//                    $queryParams[] = implode('/', [$this->moduleUrl, $action->controller->id, $action->id]);
//                    $backUrl = \Yii::$app->urlManager->createUrl($queryParams);
//                    \Yii::$app->user->setReturnUrl($backUrl);

                    return $this->redirect(\Yii::$app->urlManager->createUrl('auth/auth/login'));
                }
            ],
        ];
    }
}
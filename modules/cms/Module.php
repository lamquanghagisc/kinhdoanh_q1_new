<?php

/**
 * Description of Module
 *
 * @author admin
 */

namespace app\modules\cms;

use app\modules\cms\services\AuthService;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
    }


    public function behaviors()
    {
        return  [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ]
        ];
    }
}

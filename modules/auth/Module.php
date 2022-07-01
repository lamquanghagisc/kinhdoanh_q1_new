<?php

/**
 * Description of Module
 *
 * @author admin
 */

namespace app\modules\auth;

use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $actionModules = [];
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

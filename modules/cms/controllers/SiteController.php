<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/29/2018
 * Time: 9:49 AM
 */
namespace app\modules\cms\controllers;


use app\modules\quanly\controllers\BaseController;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
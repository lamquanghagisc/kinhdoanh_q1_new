<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 9/25/2021
 * Time: 10:53 AM
 */

namespace app\modules\qldanhmuc\controllers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

//use app\modules\base\BaseController;

class SiteController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }

}
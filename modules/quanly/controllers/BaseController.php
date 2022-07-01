<?php

namespace app\modules\quanly\controllers;

use app\modules\auth\models\AuthAssignment;
use app\modules\auth\services\AuthService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class BaseController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {

        if (!parent::beforeAction($action)) {
            return false;
        }

        $actionKey =  $this->module->id . '.' . Yii::$app->controller->id . '.' . $action->id;
       
        if (AuthService::can(Yii::$app->user->id, $actionKey)) {
            return true;
        }

        $this->denyAccess(Yii::$app->user);
    }


    protected function denyAccess($user)
    {
        
        if ($user !== false && $user->getIsGuest()) {
            $user->loginRequired();
        } else {
            Yii::$app->session->setFlash('error', 'Bạn không có quyền truy cập!');
//            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }
    }
}

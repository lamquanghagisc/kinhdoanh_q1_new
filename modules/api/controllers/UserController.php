<?php

namespace app\modules\api\controllers;

use app\modules\api\services\UserService;
use app\modules\Constant;
use app\modules\cms\models\AuthUser;
use app\modules\contrib\helper\ApiUtils;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{

    public function actionIndex()
    {
        $users = UserService::getAll();
        return ApiUtils::toJsonResponse($users);
    }

    public function actionCreate()
    {
        $model = new AuthUser();

        if (UserService::create($model, \Yii::$app->request->post())) {
            unset($model->password);
            return ApiUtils::toJsonResponse($model);
        }

        return ApiUtils::toJsonResponse(null, false, $model->errors);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (UserService::update($model, \Yii::$app->request->post())) {
            unset($model->password);
            return ApiUtils::toJsonResponse($model);
        }

        return ApiUtils::toJsonResponse(null, false, $model->errors);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (UserService::delete($model)) {
            return ApiUtils::toJsonResponse('');
        }
        return ApiUtils::toJsonResponse(null, false);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        unset($model->password);
        $model = UserService::loadPermissions($model);
        return ApiUtils::toJsonResponse($model);
    }

    private function findModel($id)
    {
        $model = AuthUser::find()->where(['status' => Constant::STATUS_ACTIVE, 'id' => $id])->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested Item could not be found.');
    }
}

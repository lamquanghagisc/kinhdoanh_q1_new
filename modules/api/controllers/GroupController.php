<?php

namespace app\modules\api\controllers;

use app\modules\api\services\GroupService;
use app\modules\auth\models\AuthGroup;
use app\modules\Constant;
use app\modules\contrib\helper\ApiUtils;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class GroupController extends Controller
{
    public function actionIndex()
    {
        $groups = GroupService::getAll();
        return ApiUtils::toJsonResponse($groups);
    }

    public function actionCreate()
    {
        $model = new AuthGroup();

        if (GroupService::create($model, \Yii::$app->request->post())) {
            return ApiUtils::toJsonResponse($model);
        }

        return ApiUtils::toJsonResponse(null, false, $model->errors);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (GroupService::update($model, \Yii::$app->request->post())) {
            return ApiUtils::toJsonResponse($model);
        }

        return ApiUtils::toJsonResponse(null, false, $model->errors);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return ApiUtils::toJsonResponse($model);
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (GroupService::delete($model)) {
            return ApiUtils::toJsonResponse('');
        }

        return ApiUtils::toJsonResponse(null, false);
    }

    private function findModel($id)
    {
        $model = AuthGroup::find()->where(['status' => Constant::STATUS_ACTIVE, 'id' => $id])->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested Item could not be found.');
    }
}

<?php

namespace app\modules\api\controllers;

use app\modules\auth\models\UserRefreshToken;
use app\modules\auth\services\AuthService;
use app\modules\contrib\helper\ApiUtils;
use Yii;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $model = new \app\models\LoginForm();
        $token = AuthService::loginREST($model, Yii::$app->request->getBodyParams());
        if ($token !== null) {
            return ApiUtils::toJsonResponse([
                'token' => (string) $token,
            ]);
        } else {
            return ApiUtils::toJsonResponse(null, false, $model->getFirstErrors());
        }
    }

    public function actionRefreshToken()
    {
        $refreshToken = Yii::$app->request->cookies->getValue('refresh-token', false);
        if (!$refreshToken) {
            throw new \yii\web\UnauthorizedHttpException('No refresh token found.');
        }

        $userRefreshToken = UserRefreshToken::findOne(['token' => $refreshToken]);

        if (Yii::$app->request->isPost) {
            $token = AuthService::refreshToken($userRefreshToken);

            return ApiUtils::toJsonResponse([
                'token' => (string) $token,
            ]);
        } elseif (Yii::$app->request->isDelete) {
            // Logging out
            if ($userRefreshToken && !$userRefreshToken->delete()) {
                throw new \yii\web\ServerErrorHttpException('Failed to delete the refresh token.');
            }

            return ApiUtils::toJsonResponse(null, true);
        }
    }

    public function actionUserinfo()
    {
        $userId = AuthService::getUserIdFromRequest();
        if ($userId) {
            return $this->redirect(['users/' . $userId]);
        }
        return ApiUtils::toJsonResponse(null, true, 'UserId is empty');
    }
}

<?php

namespace app\modules\contrib\helper;

use Yii;
use yii\web\Response;

class ApiUtils
{
    public static function toJsonResponse($data, $success = true, $message = '')
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        Yii::$app->response->data = [
            'data' => $data,
            'success' => $success,
            'message' => $message
        ];
        return Yii::$app->response;
    }
}

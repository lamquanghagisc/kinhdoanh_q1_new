<?php

namespace app\modules\api\services;

use app\modules\auth\services\AuthService;
use app\modules\cms\models\AuthUser;
use app\modules\Constant;
use yii\helpers\ArrayHelper;

class UserService
{

    /**
     * Get all
     *
     * @return AuthUser[]
     */
    public static function getAll()
    {
        return AuthUser::find()->where(['status' => Constant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * Create
     *
     * @param AuthUser $model
     * @param array $post
     * @return bool
     */
    public static function create($model, $post)
    {
        if ($model->load($post, '')) {
            $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            $model->status = Constant::STATUS_ACTIVE;
            return $model->save();
        }

        return false;
    }

    /**
     * Update
     *
     * @param AuthUser $model
     * @param array $post
     * @return bool
     */
    public static function update($model, $post)
    {
        if (isset($post['password'])) unset($post['password']);

        if ($model->load($post, '')) {
            return $model->save();
        }

        return false;
    }

    /**
     * Delete
     *
     * @param AuthUser $model
     * @return bool
     */
    public static function delete($model)
    {
        $model->status = Constant::STATUS_DELETED;
        return $model->save();
    }

    /**
     * Load permissions
     *
     * @param AuthUser $model
     * @return array
     */
    public static function loadPermissions($model)
    {
        $id = $model->id;
        $attributes = $model->attributes;
        $attributes['groups'] = AuthService::getGroupsByUserId($id);
        $attributes['roles'] = AuthService::getRolesByUserId($id);
        $attributes['data'] = AuthService::getDataByUserId($id);
        $attributes['actions'] = AuthService::GetActionsByUserId($id);

        return $attributes;
    }
}

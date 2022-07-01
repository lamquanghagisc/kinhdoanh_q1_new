<?php

namespace app\modules\auth\services;

use app\modules\Constant;
use app\modules\auth\models\AuthRole;
use app\modules\auth\models\AuthRoleAction;
use app\modules\auth\models\form\AuthRoleForm;
use app\modules\contrib\helper\DateHelper;
use app\modules\contrib\helper\TransactionHelper;

class AuthRoleService
{
    #region Public

    /**
     * Create
     *
     * @param AuthRole $model
     * @param array $post
     * @return bool
     */
    public static function create($model, $post)
    {
        if ($model->load($post)) {
            $model->created_at = DateHelper::now();
            $model->status = Constant::STATUS_ACTIVE;
            return TransactionHelper::run(function () use ($model) {
                return $model->save() && static::saveActions($model);
            });
        }

        return false;
    }

    /**
     * Update
     *
     * @param AuthRole $model
     * @param array $post
     * @return bool
     */
    public static function update($model, $post)
    {
        if ($model->load($post)) {
            $model->updated_at = DateHelper::now();
            return TransactionHelper::run(function () use ($model) {
                return $model->save() && static::saveActions($model);
            });
        }

        return false;
    }

    /**
     * Delete
     *
     * @param AuthRole $model
     * @return bool
     */
    public static function delete($model)
    {
        $model->status = Constant::STATUS_DELETED;
        return $model->save();
    }

    /**
     * Get All
     *
     * @return AuthRole[]
     */
    public static function getAll()
    {
        return AuthRole::find()->where(['status' => Constant::STATUS_ACTIVE])->asArray()->all();
    }

    #endregion

    #region Private

    /**
     * Save actions
     *
     * @param AuthRoleForm $model
     * @return bool
     */
    private static function saveActions($model)
    {
        if ($model->actionIds == null) return true;

        $result = true;
        foreach ($model->actionIds as $actionId) {
            $roleAction  = new AuthRoleAction();
            $roleAction->action_id = $actionId;
            $roleAction->role_id = $model->id;
            $result = $result && $roleAction->save();
        }

        return $result;
    }

    #endregion
}

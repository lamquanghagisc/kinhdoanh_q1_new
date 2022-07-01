<?php

namespace app\modules\auth\services;

use app\modules\Constant;
use app\modules\auth\models\AuthGroup;
use app\modules\auth\models\AuthGroupRole;
use app\modules\auth\models\form\AuthGroupForm;
use app\modules\contrib\helper\DateHelper;
use app\modules\contrib\helper\TransactionHelper;

class AuthGroupService
{
    #region Public
    /**
     * Create
     *
     * @param AuthGroupForm $model
     * @param array $post
     * @return bool
     */
    public static function create($model, $post)
    {
        if ($model->load($post)) {
            $model->created_at = DateHelper::now();
            $model->status = Constant::STATUS_ACTIVE;
            return TransactionHelper::run(function () use ($model) {
                return $model->save() && static::saveRoles($model);
            });
        }

        return false;
    }

    /**
     * Update
     *
     * @param AuthGroupForm $model
     * @param array $post
     * @return bool
     */
    public static function update($model, $post)
    {
        if ($model->load($post)) {
            $model->updated_at = DateHelper::now();
            return TransactionHelper::run(function () use ($model) {
                return $model->save() && static::saveRoles($model);
            });
        }

        return false;
    }

    /**
     * Delete
     *
     * @param AuthGroup $model
     * @return bool
     */
    public static function delete($model)
    {
        $model->status = Constant::STATUS_DELETED;
        return $model->save();
    }

    #endregion

    #region Private

    /**
     * Save roles
     *
     * @param AuthGroupForm $model
     * @return bool
     */
    private static function saveRoles($model)
    {
        AuthGroupRole::deleteAll(['group_id' => $model->id]);

        if ($model->roleIds == null) return true;
        $result = true;
        foreach ($model->roleIds as $roleId) {
            $groupRole = new AuthGroupRole();
            $groupRole->group_id = $model->id;
            $groupRole->role_id = $roleId;
            $result = $result && $groupRole->save();
        }
        return $result;
    }

    #endregion
}

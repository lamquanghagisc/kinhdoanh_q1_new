<?php

namespace app\modules\api\services;

use app\modules\auth\models\AuthGroup;
use app\modules\Constant;
use app\modules\contrib\helper\DateHelper;

class GroupService
{
    /**
     * Get all
     *
     * @return AuthGroup[]
     */
    public static function getAll()
    {
        return AuthGroup::find()->where(['status' => Constant::STATUS_ACTIVE])->asArray()->all();
    }

    /**
     * Create
     *
     * @param AuthGroup $model
     * @param array $post
     * @return bool
     */
    public static function create($model, $post)
    {
        if ($model->load($post, '')) {
            $model->status = Constant::STATUS_ACTIVE;
            $model->created_at = DateHelper::now();
            return $model->save();
        }

        return false;
    }


    /**
     * Update
     *
     * @param AuthGroup $model
     * @param array $post
     * @return bool
     */
    public static function update($model, $post)
    {
        if ($model->load($post, '')) {
            $model->updated_at = DateHelper::now();
            return $model->save();
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
}

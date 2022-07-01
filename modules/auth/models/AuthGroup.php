<?php

namespace app\modules\auth\models;

use app\modules\auth\models\generate\AuthGroupGen;
use yii\helpers\ArrayHelper;

class AuthGroup extends AuthGroupGen
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['description'], 'required'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'description' => 'Mô tả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'status' => 'Status',
        ];
    }

    public function getGroupRoles()
    {
        return $this->hasMany(AuthGroupRole::class, ['group_id' => 'id']);
    }

    public function getRoles()
    {
        return $this->hasMany(AuthRole::class, ['id' => 'role_id'])->via('groupRoles');
    }

    public function getAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['group_id' => 'id']);
    }
}

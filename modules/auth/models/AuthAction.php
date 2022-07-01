<?php

namespace app\modules\auth\models;

use app\modules\auth\models\generate\AuthActionGen;

class AuthAction extends AuthActionGen
{
    public function attributeLabels()
    {
        return [
            'name' => 'Tên',
            'desciption' => 'Mô tả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ];
    }

    public function getRoleActions()
    {
        return $this->hasMany(AuthRoleAction::class, ['action_id' => 'id']);
    }
}

<?php

namespace app\modules\auth\models;

use app\modules\auth\models\generate\AuthRoleGen;

class AuthRole extends AuthRoleGen
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'desciption' => 'Mô tả',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'status' => 'Status',
        ];
    }

    public function getRoleActions()
    {
        return $this->hasMany(AuthRoleAction::class, ['role_id' => 'id']);
    }

    public function getActions()
    {
        return $this->hasMany(AuthAction::class, ['id' => 'action_id'])->via('roleActions');
    }

    public function getGroupRoles()
    {
        return $this->hasMany(AuthGroupRole::class, ['role_id' => 'id']);
    }

    public function getGroups()
    {
        return $this->hasMany(AuthGroup::class, ['id' => 'group_id'])->via('groupRoles');
    }
}

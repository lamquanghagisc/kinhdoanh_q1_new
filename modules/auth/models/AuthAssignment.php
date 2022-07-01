<?php

namespace app\modules\auth\models;

use app\modules\auth\models\generate\AuthAssignmentGen;

class AuthAssignment extends AuthAssignmentGen
{
    public function getGroup()
    {
        return $this->hasOne(AuthGroup::class, ['id' => 'group_id']);
    }
}

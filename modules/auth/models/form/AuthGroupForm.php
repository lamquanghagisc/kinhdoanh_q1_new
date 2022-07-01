<?php

namespace app\modules\auth\models\form;

use app\modules\auth\models\AuthGroup;
use yii\helpers\ArrayHelper;

class AuthGroupForm extends AuthGroup
{
    public $roleIds = [];

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['roleIds', 'each', 'rule' => ['integer']],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'roleIds' => 'Quyền truy cập',
        ]);
    }

    public function loadRoleIds()
    {
        $this->roleIds = ArrayHelper::getColumn($this->roles, 'id');
    }
}

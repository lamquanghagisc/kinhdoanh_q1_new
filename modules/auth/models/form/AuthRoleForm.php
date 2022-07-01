<?php

namespace app\modules\auth\models\form;

use app\modules\auth\models\AuthRole;
use yii\helpers\ArrayHelper;

class AuthRoleForm extends AuthRole
{
    public $actionIds = [];

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['actionIds', 'each', 'rule' => ['integer']],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'actionIds' => 'Actions',
        ]);
    }

    public function loadActionIds()
    {
        $this->actionIds = ArrayHelper::getColumn($this->actions, 'id');
    }
}

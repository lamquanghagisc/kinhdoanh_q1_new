<?php

namespace app\modules\auth\models\generate;

use Yii;

/**
 * This is the model class for table "auth_role_action".
 *
 * @property int $id
 * @property int $role_id
 * @property int $action_id
 */
class AuthRoleActionGen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_role_action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'action_id'], 'required'],
            [['role_id', 'action_id'], 'default', 'value' => null],
            [['role_id', 'action_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'action_id' => 'Action ID',
        ];
    }
}

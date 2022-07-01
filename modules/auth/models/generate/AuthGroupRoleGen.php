<?php

namespace app\modules\auth\models\generate;

use Yii;

/**
 * This is the model class for table "auth_group_role".
 *
 * @property int $id
 * @property int $group_id
 * @property int $role_id
 */
class AuthGroupRoleGen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_group_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'role_id'], 'required'],
            [['group_id', 'role_id'], 'default', 'value' => null],
            [['group_id', 'role_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'role_id' => 'Role ID',
        ];
    }
}

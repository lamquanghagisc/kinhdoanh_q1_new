<?php

namespace app\modules\auth\models\generate;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property int $id
 * @property string|null $created_at
 * @property int|null $user_id
 * @property int|null $group_id
 */
class AuthAssignmentGen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['user_id', 'group_id'], 'default', 'value' => null],
            [['user_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
        ];
    }
}

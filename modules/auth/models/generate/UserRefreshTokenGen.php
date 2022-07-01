<?php

namespace app\modules\auth\models\generate;

use Yii;

/**
 * This is the model class for table "user_refresh_token".
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $ip
 * @property string $user_agent
 * @property string $created_at
 */
class UserRefreshTokenGen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_refresh_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'token', 'ip', 'user_agent'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['token', 'user_agent'], 'string', 'max' => 1000],
            [['ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'token' => 'Token',
            'ip' => 'Ip',
            'user_agent' => 'User Agent',
            'created_at' => 'Created At',
        ];
    }
}

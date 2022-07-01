<?php

namespace app\modules\auth\models\generate;

use Yii;

/**
 * This is the model class for table "auth_role".
 *
 * @property int $id
 * @property string $name
 * @property string|null $desciption
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status
 */
class AuthRoleGen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'default', 'value' => null],
            [['status'], 'integer'],
            [['name', 'desciption'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desciption' => 'Desciption',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}

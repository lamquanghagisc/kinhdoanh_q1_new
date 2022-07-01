<?php

namespace app\modules\qldanhmuc\models;
use app\modules\base\BaseModel;
use app\modules\quanly\models\HokdGiayphep;
use Yii;

/**
 * This is the model class for table "dm_giayphep".
 *
 * @property int $id_gp
 * @property string|null $ten_gp Tên giấy phép
 * @property string|null $ghi_chu Ghi chú
 *
 * @property HokdGiayphep[] $hokdGiaypheps
 */
class DmGiayphep extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_giayphep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_gp', 'ghi_chu'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_gp' => 'Id Gp',
            'ten_gp' => 'Ten Gp',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * Gets query for [[HokdGiaypheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHokdGiaypheps()
    {
        return $this->hasMany(HokdGiayphep::className(), ['id_gp' => 'id_gp']);
    }
}

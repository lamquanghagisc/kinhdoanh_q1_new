<?php

namespace app\modules\qldanhmuc\models;

use app\modules\quanly\models\HoKinhDoanh;
use Yii;

/**
 * This is the model class for table "dm_nganhnghe".
 *
 * @property int $id_nn
 * @property string|null $ten_nganh Tên ngành nghề
 * @property string|null $ghi_chu Ghi chú
 *

 * @property HoKinhDoanh[] $hoKinhDoanhs
 */
class DmNganhnghe extends \app\modules\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_nganhnghe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_nganh', 'ghi_chu'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_nn' => 'Id Nn',
            'ten_nganh' => 'Ten Nganh',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    

    /**
     * Gets query for [[HoKinhDoanhs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHoKinhDoanhs()
    {
        return $this->hasMany(HoKinhDoanh::className(), ['id_nn' => 'id_nn']);
    }
}

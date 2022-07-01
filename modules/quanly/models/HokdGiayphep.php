<?php

namespace app\modules\quanly\models;
use app\modules\base\BaseModel;
use app\modules\qldanhmuc\models\DmGiayphep;
use Yii;

/**
 * This is the model class for table "hokd_giayphep".
 *
 * @property string|null $thoi_han Thời hạn
 * @property int $id_hkd_gp
 * @property string|null $so_gp Số giấy phép
 * @property string|null $tinh_trang Tình trạng 
 * @property int|null $id_gp Tham chiếu dm_giayphep
 * @property int|null $id_hkd Tham chiếu ho_kinh_doanh
 * @property string|null $duong_dan Đường dẫn
 *
 * @property DmGiayphep $gp
 * @property HoKinhDoanh $hkd
 */
class HokdGiayphep extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hokd_giayphep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thoi_han'], 'safe'],
            [['so_gp', 'tinh_trang', 'duong_dan'], 'string'],
            [['id_gp', 'id_hkd'], 'default', 'value' => null],
            [['id_gp', 'id_hkd'], 'integer'],
            [['id_gp'], 'exist', 'skipOnError' => true, 'targetClass' => DmGiayphep::className(), 'targetAttribute' => ['id_gp' => 'id_gp']],
            [['id_hkd'], 'exist', 'skipOnError' => true, 'targetClass' => HoKinhDoanh::className(), 'targetAttribute' => ['id_hkd' => 'id_hkd']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'thoi_han' => 'Thoi Han',
            'id_hkd_gp' => 'Id Hkd Gp',
            'so_gp' => 'So Gp',
            'tinh_trang' => 'Tinh Trang',
            'id_gp' => 'Id Gp',
            'id_hkd' => 'Id Hkd',
            'duong_dan' => 'Duong Dan',
        ];
    }

    /**
     * Gets query for [[Gp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGp()
    {
        return $this->hasOne(DmGiayphep::className(), ['id_gp' => 'id_gp']);
    }

    /**
     * Gets query for [[Hkd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHkd()
    {
        return $this->hasOne(HoKinhDoanh::className(), ['id_hkd' => 'id_hkd']);
    }
}

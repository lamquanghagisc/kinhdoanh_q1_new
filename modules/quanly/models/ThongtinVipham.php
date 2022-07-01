<?php

namespace app\modules\quanly\models;
use app\modules\base\BaseModel;
use Yii;

/**
 * This is the model class for table "thongtin_vipham".
 *
 * @property int $id_ttvp
 * @property string|null $noidung_vipham Thông tin vi phạm
 * @property string|null $quyetdinh_so Số quyết định
 * @property string|null $quyetdinh_ngay Ngày ra quyết định
 * @property string|null $hinhthuc_phat Hình thức xử phạt
 * @property string|null $ghi_chu Ghi chú
 * @property int|null $id_hkd
 * @property string|null $bienban_so Số biên bản
 * @property string|null $donvi_lap Đơn vị lập biên bản
 * @property string|null $donvi_qd Đơn vị ra quyết định
 * @property string|null $ngay_lap Ngày lập
 *
 * @property HoKinhDoanh $hkd
 */
class ThongtinVipham extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thongtin_vipham';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noidung_vipham', 'quyetdinh_so', 'hinhthuc_phat', 'ghi_chu', 'bienban_so', 'donvi_lap', 'donvi_qd'], 'string'],
            [['quyetdinh_ngay', 'ngay_lap'], 'safe'],
            [['id_hkd'], 'default', 'value' => null],
            [['id_hkd'], 'integer'],
            [['id_hkd'], 'exist', 'skipOnError' => true, 'targetClass' => HoKinhDoanh::className(), 'targetAttribute' => ['id_hkd' => 'id_hkd']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ttvp' => 'Id Ttvp',
            'noidung_vipham' => 'Noidung Vipham',
            'quyetdinh_so' => 'Quyetdinh So',
            'quyetdinh_ngay' => 'Quyetdinh Ngay',
            'hinhthuc_phat' => 'Hinhthuc Phat',
            'ghi_chu' => 'Ghi Chu',
            'id_hkd' => 'Id Hkd',
            'bienban_so' => 'Bienban So',
            'donvi_lap' => 'Donvi Lap',
            'donvi_qd' => 'Donvi Qd',
            'ngay_lap' => 'Ngay Lap',
        ];
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

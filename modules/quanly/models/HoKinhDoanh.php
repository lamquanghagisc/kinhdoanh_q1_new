<?php

namespace app\modules\quanly\models;

use app\modules\qldanhmuc\models\DmNganhnghe;
use Yii;

/**
 * This is the model class for table "ho_kinh_doanh".
 *
 * @property int $id_hkd
 * @property string|null $ten_hkd Tên hộ kinh doanh
 * @property string|null $dien_thoai Số diện thoại
 * @property string|null $fax Số Fax
 * @property string|null $email Email
 * @property string|null $nganh_nghe Ngành, nghề kinh doanh
 * @property string|null $website Website
 * @property float|null $von_kd Vốn kinh doanh
 * @property string|null $dai_dien Người đại diện
 * @property string|null $dan_toc Dân tộc
 * @property string|null $ngay_sinh Ngày sinh
 * @property string|null $quoc_tich Quốc tịch
 * @property string|null $cmnd Số chứng minh nhân dân
 * @property string|null $ngay_cap Ngày cấp CMND
 * @property string|null $noi_cap Nơi cấp CMND
 * @property string|null $hokhau_thuongtru Hộ khẩu thường trú
 * @property string|null $noisong_hientai Chổ ở hiện tại
 * @property string|null $so_nha Số nhà
 * @property string|null $ten_duong Tên đường
 * @property string|null $ten_phuong Tên phường
 * @property string|null $vi_tri Vị trí gian hàng
 * @property string|null $giayphep_so Số giấy phép ĐKKD
 * @property string|null $ghi_chu Ghi chú
 * @property string|null $tinh_trang Tình trạng hoạt động
 * @property string|null $geom Toạ độ
 * @property int|null $id_nn Tham chiếu dm_nganhnghe
 * @property string|null $giayphep_ngay Ngày đăng ký giấy phép
 * @property string|null $ten_quan Tên quận
 * @property int|null $gioi_tinh Giới tính
 * @property string|null $tu_ngay
 * @property string|null $den_ngay Đến ngày
 * @property string|null $ma_thue Mã số thuế
 * @property string|null $nha
 * @property string|null $cap1 Cấp 1
 * @property string|null $cap2 Cấp 2
 * @property string|null $cap3 Cấp 3
 * @property string|null $cap4 Cấp 4
 * @property string|null $cap5 Cấp 5
 * @property string|null $tinhtrang_thue Tình trạng thuế
 *
 * @property DmNganhnghe $nn
 * @property HokdGiayphep[] $hokdGiaypheps
 * @property ThongtinVipham[] $thongtinViphams
 */
class HoKinhDoanh extends \app\modules\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ho_kinh_doanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_hkd', 'dien_thoai', 'fax', 'email', 'nganh_nghe', 'website', 'dai_dien', 'dan_toc', 'quoc_tich', 'cmnd', 'noi_cap', 'hokhau_thuongtru', 'noisong_hientai', 'so_nha', 'ten_duong', 'ten_phuong', 'vi_tri', 'giayphep_so', 'ghi_chu', 'tinh_trang', 'geom', 'ten_quan', 'ma_thue', 'nha', 'cap1', 'cap2', 'cap3', 'cap4', 'cap5', 'tinhtrang_thue'], 'string'],
            [['von_kd'], 'number'],
            [['ngay_sinh', 'ngay_cap', 'giayphep_ngay', 'tu_ngay', 'den_ngay'], 'safe'],
            [['id_nn', 'gioi_tinh'], 'default', 'value' => null],
            [['id_nn', 'gioi_tinh'], 'integer'],
            [['id_nn'], 'exist', 'skipOnError' => true, 'targetClass' => DmNganhnghe::className(), 'targetAttribute' => ['id_nn' => 'id_nn']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_hkd' => 'Id Hkd',
            'ten_hkd' => 'Ten Hkd',
            'dien_thoai' => 'Dien Thoai',
            'fax' => 'Fax',
            'email' => 'Email',
            'nganh_nghe' => 'Nganh Nghe',
            'website' => 'Website',
            'von_kd' => 'Von Kd',
            'dai_dien' => 'Dai Dien',
            'dan_toc' => 'Dan Toc',
            'ngay_sinh' => 'Ngay Sinh',
            'quoc_tich' => 'Quoc Tich',
            'cmnd' => 'Cmnd',
            'ngay_cap' => 'Ngay Cap',
            'noi_cap' => 'Noi Cap',
            'hokhau_thuongtru' => 'Hokhau Thuongtru',
            'noisong_hientai' => 'Noisong Hientai',
            'so_nha' => 'So Nha',
            'ten_duong' => 'Ten Duong',
            'ten_phuong' => 'Ten Phuong',
            'vi_tri' => 'Vi Tri',
            'giayphep_so' => 'Giayphep So',
            'ghi_chu' => 'Ghi Chu',
            'tinh_trang' => 'Tinh Trang',
            'geom' => 'Geom',
            'id_nn' => 'Id Nn',
            'giayphep_ngay' => 'Giayphep Ngay',
            'ten_quan' => 'Ten Quan',
            'gioi_tinh' => 'Gioi Tinh',
            'tu_ngay' => 'Tu Ngay',
            'den_ngay' => 'Den Ngay',
            'ma_thue' => 'Ma Thue',
            'nha' => 'Nha',
            'cap1' => 'Cap1',
            'cap2' => 'Cap2',
            'cap3' => 'Cap3',
            'cap4' => 'Cap4',
            'cap5' => 'Cap5',
            'tinhtrang_thue' => 'Tinhtrang Thue',
        ];
    }

    /**
     * Gets query for [[Nn]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNn()
    {
        return $this->hasOne(DmNganhnghe::className(), ['id_nn' => 'id_nn']);
    }

    /**
     * Gets query for [[HokdGiaypheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHokdGiaypheps()
    {
        return $this->hasMany(HokdGiayphep::className(), ['id_hkd' => 'id_hkd']);
    }

    /**
     * Gets query for [[ThongtinViphams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThongtinViphams()
    {
        return $this->hasMany(ThongtinVipham::className(), ['id_hkd' => 'id_hkd']);
    }
}

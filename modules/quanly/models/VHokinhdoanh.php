<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "v_hokinhdoanh".
 *
 * @property int|null $id_hkd
 * @property string|null $ten_hkd
 * @property string|null $dien_thoai
 * @property string|null $fax
 * @property string|null $email
 * @property string|null $nganh_nghe
 * @property string|null $website
 * @property string|null $dai_dien
 * @property string|null $dan_toc
 * @property string|null $ngay_sinh
 * @property string|null $quoc_tich
 * @property string|null $cmnd
 * @property string|null $ngay_cap
 * @property string|null $noi_cap
 * @property string|null $hokhau_thuongtru
 * @property string|null $noisong_hientai
 * @property string|null $so_nha
 * @property string|null $ten_duong
 * @property string|null $ten_phuong
 * @property string|null $vi_tri
 * @property string|null $giayphep_so
 * @property string|null $ghi_chu
 * @property string|null $tinh_trang
 * @property string|null $geom
 * @property int|null $id_nn
 * @property string|null $giayphep_ngay
 * @property string|null $ten_quan
 * @property int|null $gioi_tinh
 * @property string|null $tu_ngay
 * @property string|null $den_ngay
 * @property string|null $ma_thue
 * @property float|null $geo_x
 * @property float|null $geo_y
 * @property string|null $ten_nganh
 * @property float|null $von_kd
 * @property string|null $cap1
 */
class VHokinhdoanh extends \app\modules\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_hokinhdoanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_hkd', 'id_nn', 'gioi_tinh'], 'default', 'value' => null],
            [['id_hkd', 'id_nn', 'gioi_tinh'], 'integer'],
            [['ten_hkd', 'dien_thoai', 'fax', 'email', 'nganh_nghe', 'website', 'dai_dien', 'dan_toc', 'quoc_tich', 'cmnd', 'noi_cap', 'hokhau_thuongtru', 'noisong_hientai', 'so_nha', 'ten_duong', 'ten_phuong', 'vi_tri', 'giayphep_so', 'ghi_chu', 'tinh_trang', 'geom', 'ten_quan', 'ma_thue', 'ten_nganh', 'cap1'], 'string'],
            [['ngay_sinh', 'ngay_cap', 'giayphep_ngay', 'tu_ngay', 'den_ngay'], 'safe'],
            [['geo_x', 'geo_y', 'von_kd'], 'number'],
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
            'geo_x' => 'Geo X',
            'geo_y' => 'Geo Y',
            'ten_nganh' => 'Ten Nganh',
            'von_kd' => 'Von Kd',
            'cap1' => 'Cap1',
        ];
    }
}

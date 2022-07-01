<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\HoKinhDoanh;

/**
 * HoKinhDoanhSearch represents the model behind the search form about `app\modules\quanly\models\HoKinhDoanh`.
 */
class HoKinhDoanhSearch extends HoKinhDoanh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hkd', 'id_nn', 'gioi_tinh'], 'integer'],
            [['ten_hkd', 'dien_thoai', 'fax', 'email', 'nganh_nghe', 'website', 'dai_dien', 'dan_toc', 'ngay_sinh', 'quoc_tich', 'cmnd', 'ngay_cap', 'noi_cap', 'hokhau_thuongtru', 'noisong_hientai', 'so_nha', 'ten_duong', 'ten_phuong', 'vi_tri', 'giayphep_so', 'ghi_chu', 'tinh_trang', 'geom', 'giayphep_ngay', 'ten_quan', 'tu_ngay', 'den_ngay', 'ma_thue', 'nha', 'cap1', 'cap2', 'cap3', 'cap4', 'cap5', 'tinhtrang_thue'], 'safe'],
            [['von_kd'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HoKinhDoanh::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_hkd' => $this->id_hkd,
            'von_kd' => $this->von_kd,
            'ngay_sinh' => $this->ngay_sinh,
            'ngay_cap' => $this->ngay_cap,
            'id_nn' => $this->id_nn,
            'giayphep_ngay' => $this->giayphep_ngay,
            'gioi_tinh' => $this->gioi_tinh,
            'tu_ngay' => $this->tu_ngay,
            'den_ngay' => $this->den_ngay,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_hkd)', mb_strtoupper($this->ten_hkd)])
            ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['like', 'upper(fax)', mb_strtoupper($this->fax)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)])
            ->andFilterWhere(['like', 'upper(nganh_nghe)', mb_strtoupper($this->nganh_nghe)])
            ->andFilterWhere(['like', 'upper(website)', mb_strtoupper($this->website)])
            ->andFilterWhere(['like', 'upper(dai_dien)', mb_strtoupper($this->dai_dien)])
            ->andFilterWhere(['like', 'upper(dan_toc)', mb_strtoupper($this->dan_toc)])
            ->andFilterWhere(['like', 'upper(quoc_tich)', mb_strtoupper($this->quoc_tich)])
            ->andFilterWhere(['like', 'upper(cmnd)', mb_strtoupper($this->cmnd)])
            ->andFilterWhere(['like', 'upper(noi_cap)', mb_strtoupper($this->noi_cap)])
            ->andFilterWhere(['like', 'upper(hokhau_thuongtru)', mb_strtoupper($this->hokhau_thuongtru)])
            ->andFilterWhere(['like', 'upper(noisong_hientai)', mb_strtoupper($this->noisong_hientai)])
            ->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($this->ten_duong)])
            ->andFilterWhere(['like', 'upper(ten_phuong)', mb_strtoupper($this->ten_phuong)])
            ->andFilterWhere(['like', 'upper(vi_tri)', mb_strtoupper($this->vi_tri)])
            ->andFilterWhere(['like', 'upper(giayphep_so)', mb_strtoupper($this->giayphep_so)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)])
            ->andFilterWhere(['like', 'upper(tinh_trang)', mb_strtoupper($this->tinh_trang)])
            ->andFilterWhere(['like', 'upper(geom)', mb_strtoupper($this->geom)])
            ->andFilterWhere(['like', 'upper(ten_quan)', mb_strtoupper($this->ten_quan)])
            ->andFilterWhere(['like', 'upper(ma_thue)', mb_strtoupper($this->ma_thue)])
            ->andFilterWhere(['like', 'upper(nha)', mb_strtoupper($this->nha)])
            ->andFilterWhere(['like', 'upper(cap1)', mb_strtoupper($this->cap1)])
            ->andFilterWhere(['like', 'upper(cap2)', mb_strtoupper($this->cap2)])
            ->andFilterWhere(['like', 'upper(cap3)', mb_strtoupper($this->cap3)])
            ->andFilterWhere(['like', 'upper(cap4)', mb_strtoupper($this->cap4)])
            ->andFilterWhere(['like', 'upper(cap5)', mb_strtoupper($this->cap5)])
            ->andFilterWhere(['like', 'upper(tinhtrang_thue)', mb_strtoupper($this->tinhtrang_thue)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id_hkd',
        'ten_hkd',
        'dien_thoai',
        'fax',
        'email',
        'nganh_nghe',
        'website',
        'von_kd',
        'dai_dien',
        'dan_toc',
        'ngay_sinh',
        'quoc_tich',
        'cmnd',
        'ngay_cap',
        'noi_cap',
        'hokhau_thuongtru',
        'noisong_hientai',
        'so_nha',
        'ten_duong',
        'ten_phuong',
        'vi_tri',
        'giayphep_so',
        'ghi_chu',
        'tinh_trang',
        'geom',
        'id_nn',
        'giayphep_ngay',
        'ten_quan',
        'gioi_tinh',
        'tu_ngay',
        'den_ngay',
        'ma_thue',
        'nha',
        'cap1',
        'cap2',
        'cap3',
        'cap4',
        'cap5',
        'tinhtrang_thue',        ];
    }
}

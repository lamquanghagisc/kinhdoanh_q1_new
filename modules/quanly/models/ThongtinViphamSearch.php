<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\ThongtinVipham;

/**
 * ThongtinViphamSearch represents the model behind the search form about `app\modules\quanly\models\ThongtinVipham`.
 */
class ThongtinViphamSearch extends ThongtinVipham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ttvp', 'id_hkd'], 'integer'],
            [['noidung_vipham', 'quyetdinh_so', 'quyetdinh_ngay', 'hinhthuc_phat', 'ghi_chu', 'bienban_so', 'donvi_lap', 'donvi_qd', 'ngay_lap'], 'safe'],
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
        $query = ThongtinVipham::find();

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
            'id_ttvp' => $this->id_ttvp,
            'quyetdinh_ngay' => $this->quyetdinh_ngay,
            'id_hkd' => $this->id_hkd,
            'ngay_lap' => $this->ngay_lap,
        ]);

        $query->andFilterWhere(['like', 'upper(noidung_vipham)', mb_strtoupper($this->noidung_vipham)])
            ->andFilterWhere(['like', 'upper(quyetdinh_so)', mb_strtoupper($this->quyetdinh_so)])
            ->andFilterWhere(['like', 'upper(hinhthuc_phat)', mb_strtoupper($this->hinhthuc_phat)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)])
            ->andFilterWhere(['like', 'upper(bienban_so)', mb_strtoupper($this->bienban_so)])
            ->andFilterWhere(['like', 'upper(donvi_lap)', mb_strtoupper($this->donvi_lap)])
            ->andFilterWhere(['like', 'upper(donvi_qd)', mb_strtoupper($this->donvi_qd)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id_ttvp',
        'noidung_vipham',
        'quyetdinh_so',
        'quyetdinh_ngay',
        'hinhthuc_phat',
        'ghi_chu',
        'id_hkd',
        'bienban_so',
        'donvi_lap',
        'donvi_qd',
        'ngay_lap',        ];
    }
}

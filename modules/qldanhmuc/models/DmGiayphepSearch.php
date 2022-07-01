<?php

namespace app\modules\qldanhmuc\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\qldanhmuc\models\DmGiayphep;

/**
 * DmGiayphepSearch represents the model behind the search form about `app\modules\quanly\models\DmGiayphep`.
 */
class DmGiayphepSearch extends DmGiayphep
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gp'], 'integer'],
            [['ten_gp', 'ghi_chu'], 'safe'],
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
        $query = DmGiayphep::find();

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
            'id_gp' => $this->id_gp,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_gp)', mb_strtoupper($this->ten_gp)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id_gp',
        'ten_gp',
        'ghi_chu',        ];
    }
}

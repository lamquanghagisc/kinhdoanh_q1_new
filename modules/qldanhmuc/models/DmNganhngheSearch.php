<?php

namespace app\modules\qldanhmuc\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\qldanhmuc\models\DmNganhnghe;

/**
 * DmNganhngheSearch represents the model behind the search form about `app\modules\qldanhmuc\models\DmNganhnghe`.
 */
class DmNganhngheSearch extends DmNganhnghe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nn'], 'integer'],
            [['ten_nganh', 'ghi_chu'], 'safe'],
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
        $query = DmNganhnghe::find();

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
            'id_nn' => $this->id_nn,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_nganh)', mb_strtoupper($this->ten_nganh)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id_nn',
        'ten_nganh',
        'ghi_chu',        ];
    }
}

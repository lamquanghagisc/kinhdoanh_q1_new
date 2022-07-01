<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\cms\models\AuthUser;

/**
 * AuthUserSearch represents the model behind the search form about `app\modules\cms\models\AuthUser`.
 */
class AuthUserSearch extends AuthUser {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'active', 'confirmed'], 'integer'],
            [['username', 'email', 'password', 'auth_key', 'created_at', 'updated_at', 'password_reset_token', 'access_token', 'avatar', 'fullname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = AuthUser::find();

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
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'active' => $this->active,
            'confirmed' => $this->confirmed,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
                ->andFilterWhere(['like', 'access_token', $this->access_token])
                ->andFilterWhere(['like', 'avatar', $this->avatar])
                ->andFilterWhere(['like', 'fullname', $this->fullname])
                ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}

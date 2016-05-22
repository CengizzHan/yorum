<?php

namespace cengizzhan\yorum\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use cengizzhan\yorum\models\Yorum;

/**
 * YorumSearch represents the model behind the search form about `backend\modules\yorum\models\Yorum`.
 */
class YorumSearch extends Yorum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tip', 'yazan'], 'integer'],
            [['baslik', 'icerik'], 'safe'],
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
        $query = Yorum::find();

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
            'tip' => $this->tip,
            'yazan' => $this->yazan,
        ]);

        $query->andFilterWhere(['like', 'baslik', $this->baslik])
            ->andFilterWhere(['like', 'icerik', $this->icerik]);

        return $dataProvider;
    }
}

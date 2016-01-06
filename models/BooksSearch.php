<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'date_create', 'date_update', 'date_start', 'date_end', 'preview', 'date'], 'safe'],
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
        $query = Books::find();

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
            'author_id' => $this->author_id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'date' => $this->date,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview', $this->preview]);

        if (!empty($this->date_start)){
            $query->andFilterWhere(['>=', 'date', date('Y-m-d',strtotime($this->date_start))]);
        }
        if (!empty($this->date_end)){
            $query->andFilterWhere(['<=', 'date', date('Y-m-d',strtotime($this->date_end))]);
        }


        return $dataProvider;
    }
}

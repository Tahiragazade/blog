<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Blog;

/**
 * BlogSearch represents the model behind the search form of `backend\models\Blog`.
 */
class BlogSearch extends Blog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_time', 'updated_time', 'status'], 'integer'],
            [['name', 'janr_id', 'author_id', 'text','photo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Blog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
           
        }
         $query->joinWith('author');
            $query->joinWith('janr');

        // grid filtering conditions
        $query->andFilterWhere([
            'blog.id' => $this->id,
            
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'author.name', $this->author_id]);
        $query->andFilterWhere(['like', 'janr.name', $this->janr_id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'text', $this->text]);
        $query->andFilterWhere(['like', 'blog.photo', $this->photo]);

        return $dataProvider;
    }
}

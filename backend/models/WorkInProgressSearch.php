<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WorkInProgress;

/**
 * WorkInProgressSearch represents the model behind the search form of `common\models\WorkInProgress`.
 */
class WorkInProgressSearch extends WorkInProgress
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'taskId', 'employeeId', 'currentProgressId', 'isActive'], 'integer'],
            [['taskDetail', 'note1', 'note2', 'note3', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = WorkInProgress::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'taskId' => $this->taskId,
            'employeeId' => $this->employeeId,
            'currentProgressId' => $this->currentProgressId,
            'isActive' => $this->isActive,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'taskDetail', $this->taskDetail])
            ->andFilterWhere(['like', 'note1', $this->note1])
            ->andFilterWhere(['like', 'note2', $this->note2])
            ->andFilterWhere(['like', 'note3', $this->note3]);

        return $dataProvider;
    }
}

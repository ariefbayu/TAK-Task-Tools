<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlm_mastertasks".
 *
 * @property int $id
 * @property int $name
 *
 * @property Subtasks[] $subtasks
 * @property Workinprogress[] $workinprogresses
 * @property WorkinprogressHistory[] $workinprogressHistories
 */
class MasterTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tlm_mastertasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Subtasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubtasks()
    {
        return $this->hasMany(SubTask::className(), ['taskId' => 'id']);
    }

    /**
     * Gets query for [[Workinprogresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogresses()
    {
        return $this->hasMany(WorkInProgress::className(), ['taskId' => 'id']);
    }

    /**
     * Gets query for [[WorkinprogressHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogressHistories()
    {
        return $this->hasMany(WorkInProgressHistoryy::className(), ['taskId' => 'id']);
    }
}

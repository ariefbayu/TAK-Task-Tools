<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlm_subtasks".
 *
 * @property int $id
 * @property int $taskId
 * @property string $name
 * @property int $taskOrder
 * @property int $taskTime
 *
 * @property Mastertasks $task
 * @property Workinprogress[] $workinprogresses
 * @property WorkinprogressHistory[] $workinprogressHistories
 */
class SubTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tlm_subtasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taskId', 'name', 'taskOrder'], 'required'],
            [['taskId', 'taskOrder', 'taskTime'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['taskId'], 'exist', 'skipOnError' => true, 'targetClass' => MasterTask::className(), 'targetAttribute' => ['taskId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taskId' => 'Task ID',
            'name' => 'Name',
            'taskOrder' => 'Task Order',
            'taskTime' => 'Task Time',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Mastertask::className(), ['id' => 'taskId']);
    }

    /**
     * Gets query for [[Workinprogresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogresses()
    {
        return $this->hasMany(Workinprogress::className(), ['currentProgressId' => 'id']);
    }

    /**
     * Gets query for [[WorkinprogressHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogressHistories()
    {
        return $this->hasMany(WorkinprogressHistory::className(), ['currentWipId' => 'id']);
    }
}

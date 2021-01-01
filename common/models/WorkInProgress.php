<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlm_workinprogress".
 *
 * @property int $id
 * @property int $taskId
 * @property int $employeeId
 * @property int $currentProgressId
 * @property string $taskDetail
 * @property string|null $note1
 * @property string|null $note2
 * @property string|null $note3
 * @property int $isActive
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Mastertasks $task
 * @property Employees $employee
 * @property Subtasks $currentProgress
 * @property WorkinprogressHistory[] $workinprogressHistories
 */
class WorkInProgress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tlm_workinprogress';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taskId', 'employeeId', 'currentProgressId', 'taskDetail'], 'required'],
            [['taskId', 'employeeId', 'currentProgressId', 'isActive'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['taskDetail', 'note1', 'note2', 'note3'], 'string', 'max' => 256],
            [['taskId'], 'exist', 'skipOnError' => true, 'targetClass' => MasterTask::className(), 'targetAttribute' => ['taskId' => 'id']],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employeeId' => 'id']],
            [['currentProgressId'], 'exist', 'skipOnError' => true, 'targetClass' => SubTask::className(), 'targetAttribute' => ['currentProgressId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taskId' => 'Task',
            'employeeId' => 'Employee',
            'currentProgressId' => 'Progress',
            'taskDetail' => 'Detail',
            'note1' => 'Note 1',
            'note2' => 'Note 2',
            'note3' => 'Note 3',
            'isActive' => 'Is Active',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(MasterTask::className(), ['id' => 'taskId']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employeeId']);
    }

    /**
     * Gets query for [[CurrentProgress]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentProgress()
    {
        return $this->hasOne(SubTask::className(), ['id' => 'currentProgressId']);
    }

    /**
     * Gets query for [[WorkinprogressHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogressHistories()
    {
        return $this->hasMany(WorkInProgressHistory::className(), ['wipId' => 'id']);
    }
}

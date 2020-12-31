<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlm_workinprogress_history".
 *
 * @property int $wipId
 * @property int $taskId
 * @property int $employeeId
 * @property int $currentWipId
 * @property string $taskDetail
 * @property string $notes
 * @property string $createdAt
 *
 * @property Workinprogress $wip
 * @property Mastertasks $task
 * @property Employees $employee
 * @property Subtasks $currentWip
 */
class WorkInProgressHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tlm_workinprogress_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wipId', 'taskId', 'employeeId', 'currentWipId', 'taskDetail', 'notes'], 'required'],
            [['wipId', 'taskId', 'employeeId', 'currentWipId'], 'integer'],
            [['createdAt'], 'safe'],
            [['taskDetail', 'notes'], 'string', 'max' => 256],
            [['wipId'], 'exist', 'skipOnError' => true, 'targetClass' => Workinprogress::className(), 'targetAttribute' => ['wipId' => 'id']],
            [['taskId'], 'exist', 'skipOnError' => true, 'targetClass' => MasterTask::className(), 'targetAttribute' => ['taskId' => 'id']],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employeeId' => 'id']],
            [['currentWipId'], 'exist', 'skipOnError' => true, 'targetClass' => SubTask::className(), 'targetAttribute' => ['currentWipId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wipId' => 'Wip ID',
            'taskId' => 'Task ID',
            'employeeId' => 'Employee ID',
            'currentWipId' => 'Current Wip ID',
            'taskDetail' => 'Task Detail',
            'notes' => 'Notes',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Wip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWip()
    {
        return $this->hasOne(Workinprogress::className(), ['id' => 'wipId']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Mastertasks::className(), ['id' => 'taskId']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['id' => 'employeeId']);
    }

    /**
     * Gets query for [[CurrentWip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentWip()
    {
        return $this->hasOne(Subtasks::className(), ['id' => 'currentWipId']);
    }
}

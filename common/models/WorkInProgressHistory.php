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
            [['wipId', 'taskId', 'employeeId', 'currentWipId', 'taskDetail'], 'required'],
            [['wipId', 'taskId', 'employeeId', 'currentWipId'], 'integer'],
            [['createdAt'], 'safe'],
            [['taskDetail', 'note1', 'note2', 'note3'], 'string', 'max' => 256],
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
            'wipId' => 'WIP',
            'taskId' => 'Task',
            'employeeId' => 'Employee',
            'currentWipId' => 'Progress',
            'taskDetail' => 'Task Detail',
            'note1' => 'Note 1',
            'note2' => 'Note 2',
            'note3' => 'Note 3',
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
        return $this->hasOne(Mastertask::className(), ['id' => 'taskId']);
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
     * Gets query for [[CurrentWip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentWip()
    {
        return $this->hasOne(Subtask::className(), ['id' => 'currentWipId']);
    }

    public function loadFromWIP($wip)
    {
        $this->wipId         = $wip->id;
        $this->taskId        = $wip->taskId;
        $this->employeeId    = $wip->employeeId;
        $this->currentWipId  = $wip->currentProgressId;
        $this->taskDetail    = $wip->taskDetail;
        $this->note1         = $wip->note1;
        $this->note2         = $wip->note2;
        $this->note3         = $wip->note3;
        $this->createdAt     = date('Y-m-d H:i:s');
    }
}

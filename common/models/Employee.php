<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlm_employees".
 *
 * @property int $id
 * @property string $name
 *
 * @property Workinprogress[] $workinprogresses
 * @property WorkinprogressHistory[] $workinprogressHistories
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tlm_employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 256],
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
     * Gets query for [[Workinprogresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogresses()
    {
        return $this->hasMany(Workinprogress::className(), ['employeeId' => 'id']);
    }

    /**
     * Gets query for [[WorkinprogressHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkinprogressHistories()
    {
        return $this->hasMany(WorkinprogressHistory::className(), ['employeeId' => 'id']);
    }
}

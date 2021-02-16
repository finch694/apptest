<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string $color
 * @property int $status_id
 * @property float|null $integrity
 * @property int|null $createAt
 * @property int|null $fallAt
 *
 * @property Statuses $status
 */
class Apples extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'status_id'], 'required'],
            [['status_id', 'createAt', 'fallAt'], 'integer'],
            [['integrity'], 'number'],
            [['color'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'status_id' => 'Status ID',
            'integrity' => 'Integrity',
            'createAt' => 'Create At',
            'fallAt' => 'Fall At',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['status_id' => 'status_id']);
    }

    /**
     * {@inheritdoc}
     * @return ApplesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplesQuery(get_called_class());
    }
}

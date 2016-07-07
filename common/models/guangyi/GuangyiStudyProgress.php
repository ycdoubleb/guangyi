<?php

namespace common\models\guangyi;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%study_progress}}".
 *
 * @property string $id
 * @property integer $progress
 * @property integer $updated_at
 * @property integer $created_at
 */
class GuangyiStudyProgress extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%study_progress}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['progress', 'updated_at', 'created_at'], 'integer'],
            [['id'], 'string', 'max' => 36]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('guangyi', 'ID'),
            'progress' => Yii::t('guangyi', 'Progress'),
            'updated_at' => Yii::t('guangyi', 'Updated At'),
            'created_at' => Yii::t('guangyi', 'Created At'),
        ];
    }
}

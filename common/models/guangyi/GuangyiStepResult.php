<?php

namespace common\models\guangyi;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%step_result}}".
 *
 * @property integer $id
 * @property integer $access_id
 * @property integer $step
 * @property integer $result
 * @property integer $created_at
 * @property integer $updated_at
 */
class GuangyiStepResult extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%step_result}}';
    }
    
    public function behaviors() {
        return [TimestampBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'access_id', 'step'], 'required'],
            [['id', 'access_id', 'step', 'result', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('guangyi', 'ID'),
            'access_id' => Yii::t('guangyi', 'Access ID'),
            'step' => Yii::t('guangyi', 'Step'),
            'result' => Yii::t('guangyi', 'Result'),
            'created_at' => Yii::t('guangyi', 'Created At'),
            'updated_at' => Yii::t('guangyi', 'Updated At'),
        ];
    }
}

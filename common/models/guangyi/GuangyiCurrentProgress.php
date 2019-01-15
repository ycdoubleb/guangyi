<?php

namespace common\models\guangyi;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%current_progress}}".
 *
 * @property integer $uid
 * @property integer $progress
 * @property integer $created_at
 * @property integer $update_at
 */
class GuangyiCurrentProgress extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%current_progress}}';
    }
    
    public function behaviors() {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['progress', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('guangyi', 'UID'),
            'progress' => Yii::t('guangyi', 'Progress'),
            'created_at' => Yii::t('guangyi', 'Created At'),
            'update_at' => Yii::t('guangyi', 'Update At'),
        ];
    }
}

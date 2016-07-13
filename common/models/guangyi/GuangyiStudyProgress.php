<?php

namespace common\models\guangyi;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%study_progress}}".
 *
 * @property string $uid
 * @property integer $index
 * @property integer $result
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
    
    public function behaviors() {
        return [TimestampBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['index','result', 'updated_at', 'created_at'], 'integer'],
            [['uid'], 'string', 'max' => 36]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('guangyi', 'UID'),
            'index' => Yii::t('guangyi', 'Index'),
            'result' => Yii::t('guangyi', 'Result'),
            'updated_at' => Yii::t('guangyi', 'Updated At'),
            'created_at' => Yii::t('guangyi', 'Created At'),
        ];
    }
}

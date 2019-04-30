<?php

namespace common\models\guangyi;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%assess_log}}".
 *
 * @property integer $id
 * @property string $u_id
 * @property integer $result
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class GuangyiAssessLog extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%assess_log}}';
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
            [['u_id', 'result'], 'required'],
            [['id', 'result', 'created_at', 'updated_at'], 'integer'],
            [['u_id'], 'string', 'max' => 36],
            [['data'], 'string', 'max' => 3000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('guangyi', 'ID'),
            'u_id' => Yii::t('guangyi', 'U ID'),
            'result' => Yii::t('guangyi', 'Result'),
            'data' => Yii::t('guangyi', 'Data'),
            'created_at' => Yii::t('guangyi', 'Created At'),
            'updated_at' => Yii::t('guangyi', 'Updated At'),
        ];
    }
}

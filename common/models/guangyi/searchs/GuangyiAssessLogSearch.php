<?php

namespace common\models\guangyi\searchs;

use common\models\guangyi\GuangyiAssessLog;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

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
class GuangyiAssessLogSearch extends Model
{
    public $nickname;
    
    public function rules(){
        return [
            [['nickname'],'string']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nickname' => Yii::t('guangyi', 'AssessNickname'),
            'total' => Yii::t('guangyi', 'AssessTotal'),
            'rightTotal' => Yii::t('guangyi', 'AssessRightTotal'),
            'pcorrect' => Yii::t('guangyi', 'AssessPcorrect'),
            'created_at' => Yii::t('guangyi', 'Created At'),
            'updated_at' => Yii::t('guangyi', 'Updated At'),
        ];
    }
    /**
     * 
     * @param ArrayDataProvider $params 查找条件
     */
    public function search($params){
        $this->load($params);
        $whereCondition = '';
        if(isset($this->nickname) && $this->nickname!=''){
            $whereCondition .= " WHERE B.nickname LIKE '%$this->nickname%'";
        }
        
        $sql = "SELECT B.id AS uid, B.nickname ,COUNT(*) AS total,SUM(A.result) AS rightTotal,(SUM(A.result)/COUNT(*)) AS pcorrect
                    FROM guangyi_assess_log AS A
                    LEFT JOIN guangyi_user AS B on A.u_id = B.id
                    $whereCondition
                    GROUP BY A.u_id";
        
        $query = GuangyiAssessLog::findBySql($sql);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->asArray()->all(),
            'sort' => [
                'attributes' => ['total', 'rightTotal', 'pcorrect'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $dataProvider;
    }
}

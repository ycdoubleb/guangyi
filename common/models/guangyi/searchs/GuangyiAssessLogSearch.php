<?php

namespace common\models\guangyi\searchs;

use common\models\guangyi\GuangyiAssessLog;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

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
        $results = (new Query())
                ->select([
                    'B.id AS uid',
                    'B.nickname',
                    'COUNT(A.u_id) AS total',
                    'SUM(A.result) AS rightTotal',
                    '(SUM(A.result)/COUNT(*)) AS pcorrect'])
                ->from(['B'=>  User::tableName()])
                ->leftJoin(['A'=>  GuangyiAssessLog::tableName()], 'A.u_id = B.id')
                ->andFilterWhere(['like','B.nickname',"$this->nickname"])
                ->groupBy('B.id')
                ->all(Yii::$app->db);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $results,
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

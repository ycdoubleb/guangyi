<?php

namespace backend\modules\guangyi\controllers;

use common\models\guangyi\GuangyiAssessLog;
use common\models\guangyi\GuangyiCurrentProgress;
use common\models\guangyi\GuangyiStepResult;
use common\models\guangyi\GuangyiStudyProgress;
use common\models\guangyi\searchs\GuangyiAssessLogSearch;
use common\models\guangyi\searchs\GuangyiUserAccessSearch;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new GuangyiAssessLogSearch();
        $dataProvider = $searchModel->search(\Yii::$app->getRequest()->getQueryParams());
        $uids = ArrayHelper::getColumn($dataProvider->allModels, 'uid');
        
        $steps = GuangyiStepResult::find()
                ->select(['step','COUNT(*) AS value'])
                ->where(['u_id'=>$uids])
                ->groupBy('step')
                ->asArray()
                ->all();
  
        return $this->render('index',[
                    'steps' => $steps,
                    'dataProvider'=> $dataProvider,
                    'searchModel' => $searchModel
                ]);
    }
    
    public function actionView($uid){
        $user = User::findOne($uid);
        if($user == null)
            throw new NotFoundHttpException("找不到对应用户！");
        
        $searchModel = new GuangyiUserAccessSearch();
        $dataProvider = $searchModel->search(['uid'=>$uid]);
        
        $progressMode = GuangyiStudyProgress::find()
                ->where(['uid'=>$uid])
                ->asArray()
                ->all();
        $progressMode = ArrayHelper::map($progressMode, 'index', 'result');

        $currentProgressModel = GuangyiCurrentProgress::findOne($uid);
        
        $steps = GuangyiStepResult::find()
                ->select(['step','COUNT(*) AS value'])
                ->where(['u_id'=>$uid])
                ->groupBy('step')
                ->asArray()
                ->all();
        
        return $this->render('view', [
                    'user' => $user,
                    'steps' => $steps,
                    'dataProvider'=> $dataProvider,
                    'currentIndex'=>$currentProgressModel ? $currentProgressModel->progress : -1,
                    'progress'=>$progressMode ? $progressMode : 'null',
        ]);
    }
    
    /**
     * 创建考核数据
     * @return type
     */
    public function actionCreateData(){
        $num = 1000;
        $maxStep = 17;
        $users = User::find()->all();
        
        $inserts = [
            
        ];
        
        for($i=0,$len=$num;$i<$num;$i++)
        {
            $inserts[]=[
                $users[rand(0, count($users)-1)]->id,  rand(0, 1),  time(),  time()
            ];
        }
        
        $query = Yii::$app->db->createCommand()->batchInsert(GuangyiAssessLog::tableName(), ['u_id','result','created_at','updated_at'], $inserts);
        $query->execute();
        return $this->render('index');
    }
    
    /**
     * 创建步骤
     */
    public function actionCreateStep(){
        $num = 1000;
        $maxStep = 3;
        $users = User::find()->all();
        $assess = GuangyiAssessLog::find()->all();
        
        $inserts = [
            
        ];
        
        for($i=0,$len=$num;$i<$num;$i++)
        {
            $inserts[]=[
                $users[rand(0, count($users)-1)]->id, $assess[rand(0, count($assess)-1)]->id, rand(0, $maxStep-1), 0, time(),  time()
            ];
        }
        
        $query = Yii::$app->db->createCommand()->batchInsert(GuangyiStepResult::tableName(), ['u_id','assess_id','step','result','created_at','updated_at'], $inserts);
        $query->execute();
        return $this->render('index');
    } 
}

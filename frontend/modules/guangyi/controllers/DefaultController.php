<?php

namespace frontend\modules\guangyi\controllers;

use common\models\guangyi\GuangyiAssessLog;
use common\models\guangyi\GuangyiCurrentProgress;
use common\models\guangyi\GuangyiStepResult;
use common\models\guangyi\GuangyiStudyProgress;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use const WEB_ROOT;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [ 'get-user-info'],
                'rules' => [
                    [
                        'actions' => ['get-user-info'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * 获取用户答题信息
     * @param type $userid 用户id
     */
    public function actionGetUserInfo($userid)
    {
        Yii::$app->getResponse()->format = 'json';
        if(!\Yii::$app->user->isGuest)
        {
            $progressMode = GuangyiStudyProgress::find()
                    ->where(['uid'=>$userid])
                    ->asArray()
                    ->all();
            $progressMode = ArrayHelper::map($progressMode, 'index', 'result');

            $currentProgressModel = GuangyiCurrentProgress::findOne($userid);

            $accessModel = GuangyiAssessLog::find()
                   ->where(['u_id'=>$userid])
                    ->orderBy('created_at DESC')
                    ->asArray()
                    ->one();
            return [
                'code'=>0,
                'data'=>[
                    'userid'=>$userid,
                    'nickname'=>Yii::$app->user->identity->nickname,
                    'avatar'=>WEB_ROOT.Yii::$app->user->identity->avatar,
                    'currentIndex'=>$currentProgressModel ? $currentProgressModel->progress : -1,
                    'progress'=>$progressMode ? $progressMode : 'null',
                    'access'=>$accessModel ? $accessModel : "null",
                ]
            ];
        }else
        {
            return [
                'code'=>1,
                'message'=>'请先登录！'
            ];
        }
    }
    
    /**
     * 保存进度
     * @param string $userid        用户id
     * @param integer $index        环节
     * @param integer $result       进度
     */
    public function actionUpdateProgress($userid,$index,$result)
    {
        Yii::$app->getResponse()->format = 'json';
        if(!\Yii::$app->user->isGuest)
        {            
             /* @var $studyProgress GuangyiStudyProgress */
            $studyProgress = GuangyiStudyProgress::findOne(['uid'=>$userid,'index'=>$index]);
            if($studyProgress == null)$studyProgress = new GuangyiStudyProgress(['uid'=>$userid,'index'=>$index]);
            $studyProgress->result = $result;
            $code = $studyProgress->save();
            return [
                'code'=>$code ? 0 : 1,
                'message'=>$code?'保存成功':"保存失败",
                'err'=>$studyProgress->getFirstErrors()
            ];
        }else
        {
            return [
                'code'=>1,
                'message'=>'请先登录！'
            ];
        }
       
    }
    /**
     * 保存当前学习环节
     * @param string $userid        用户id
     * @return integer  $progress   0~N
     */
    public function  actionUpdateCurrentProgress($userid,$progress){
        Yii::$app->getResponse()->format = 'json';
        if(!\Yii::$app->user->isGuest)
        {
             /* @var $studyProgress GuangyiCurrentProgress */
            $studyProgress = GuangyiCurrentProgress::findOne(['uid'=>$userid]);
            if($studyProgress == null)$studyProgress = new GuangyiCurrentProgress(['uid'=>$userid]);
            $studyProgress->progress = $progress;
            $code = $studyProgress->save();
            return [
                'code'=>$code ? 0 : 1,
                'message'=>$code?'保存成功':"保存失败",
                'err'=>$studyProgress->getFirstErrors()
            ];
        }else
        {
            return [
                'code'=>1,
                'message'=>'请先登录！'
            ];
        }
    }
    /**
     * 保存用户考核数据
     * @param string $userid        用户id
     * @param integer $result   考核结果0失败，1成功
     * @param string $data      考核数据(JSON)
     */
    public function actionSubmitAccess($userid,$result,$data){
        Yii::$app->getResponse()->format = 'json';
        if(!\Yii::$app->user->isGuest)
        {
            $returndata = ['code'=>1,'message'=>'保存成功'];
        
            $accesslog = new GuangyiAssessLog();
            $accesslog->u_id = $userid;
            $accesslog->result = $result;
            $accesslog->data = $data;
            if(!$accesslog->save())
            {
                $returndata["code"] = 1;
                $returndata["message"] ='保存失败';
                $returndata["err"]=$accesslog->getFirstErrors();
            }else
            {
                $steps_arr = json_decode($data, true);
                $wrong_steps = [];
                $accessId = $accesslog->id;
                
                foreach($steps_arr as $step)
                {
                    if(!$step["pass"])
                        $wrong_steps[] = [$userid,$accessId,$step["trainId"]];
                }
                
                if(count($wrong_steps)>0)
                {
                    Yii::$app->db->createCommand()
                            ->batchInsert(GuangyiStepResult::tableName() ,['u_id','access_id','step'] , $wrong_steps)
                            ->execute();
                }
            }
            
            return $returndata;
        }else
        {
            return [
                'code'=>1,
                'message'=>'请先登录！'
            ];
        }
        
    }
}

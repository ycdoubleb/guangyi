<?php

namespace frontend\modules\guangyi\controllers;

use common\modules\guangyi\GuangyiAssessLog;
use common\modules\guangyi\GuangyiStudyProgress;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

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
        return [
            'code'=>0,
            'data'=>[
                'userid'=>$userid,
                'index'=>1
            ]
        ];
    }
    
    /**
     * 保存进度
     * @param string $userid      用户id
     * @param integer $progress    用户进度
     */
    public function actionSaveProgress($userid,$progress)
    {
        /* @var $studyProgress GuangyiStudyProgress */
        $studyProgress = GuangyiStudyProgress::findOne(['uid'=>$userid]);
        if($studyProgress!=null)
        {
            $studyProgress->progress = $progress;
            $studyProgress->save();
        }
    }
    /**
     * 保存用户考核数据
     * @param string $userid    用户id
     * @param integer $result   考核结果0失败，1成功
     * @param string $data      考核数据(JSON)
     */
    public function actionSaveAccess($userid,$result,$data){
        
        Yii::$app->getResponse()->format = 'json';
        $returndata = ['code'=>1,'message'=>'保存成功'];
        
        $accesslog = new GuangyiAssessLog();
        $accesslog->u_id = $userid;
        $accesslog->result = $result;
        $accesslog->data = $data;
        if(!$accesslog->save())
        {
            $returndata["code"] = 1;
            $returndata["message"] = $accesslog->getFirstErrors();
        }
        return $returndata;
    }
}

<?php

namespace backend\modules\guangyi\controllers;

use common\models\guangyi\GuangyiAssessLog;
use common\models\guangyi\GuangyiCurrentProgress;
use common\models\guangyi\GuangyiStepResult;
use common\models\guangyi\GuangyiStudyProgress;
use common\models\guangyi\searchs\GuangyiAssessLogSearch;
use common\models\guangyi\searchs\GuangyiUserAccessSearch;
use common\models\User;
use PHPExcel;
use PHPExcel_IOFactory;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' =>  AccessControl::className(),
                'rules' =>  [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }
    
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
    /**
     * 导出用户数据
     */
    public function actionExport(){
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("wskeee")
                                    ->setLastModifiedBy("wskeee")
                                    ->setTitle("成绩导出")
                                    ->setSubject("广医")
                                    ->setDescription("")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Test result file");
        // Add some data
        /*
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Hello')
                    ->setCellValue('B2', 'world!')
                    ->setCellValue('C1', 'Hello')
                    ->setCellValue('D2', 'world!');
        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'Miscellaneous glyphs')
                    ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
        */
        //添加成绩数据
        $searchModel = new GuangyiAssessLogSearch();
        $dataProvider = $searchModel->search(\Yii::$app->getRequest()->getQueryParams())
                ->allModels;
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('所有用户');
        //添加标题
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '名称')
                    ->setCellValue('B1', '考核总数')
                    ->setCellValue('C1', '答对数')
                    ->setCellValue('D1', '正确率');
        
        foreach ($dataProvider as $key => $log){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0, $key+2, $log['nickname'])
                                                ->setCellValueByColumnAndRow(1, $key+2, $log['total'])
                                                ->setCellValueByColumnAndRow(2, $key+2, $log['rightTotal'])
                                                ->setCellValueByColumnAndRow(3, $key+2, ((int)($log['pcorrect']*10000)/100).'%');
        }
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="导出成绩.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}

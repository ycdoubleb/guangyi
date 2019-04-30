<?php

namespace backend\modules\user\controllers;

use common\models\searchs\UserSearch;
use common\models\User;
use wskeee\utils\ExcelUtil;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class DefaultController extends Controller
{
   public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->getRequest()->getQueryParams());
        return $this->render('index',[
            'dataProvider'=>$dataProvider,
            'searchModel'=>$searchModel
        ]);
    }
    
     /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_CREATE;
        
        if(Yii::$app->request->isPost)
        {
            if($model->load(\Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect ('index');
            }
                
        }
        $model->loadDefaultValues();
        return $this->render('create',['model'=>$model]);
    }
    
    public function actionDelete($id)
    {
        /*@var $model User*/
        
        if(($model = $this->findModel($id)) !== null)
        {
            if($id !== Yii::$app->getUser()->getId())
            {
                $model->delete();
                return $this->redirect(['index']);
            }else
                throw new Exception('自己不可以删除自己');
        }
        else
            throw new Exception('找不到对应用户！');
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = User::SCENARIO_UPDATE;
        
        if($model->load(Yii::$app->getRequest()->post()))
        {
            if($model->save())
                return $this->redirect(['index']);
            else
                Yii::error ($model->errors);
        }else
        {
            $model->password = '';
            return $this->render('update',['model'=>$model]);
        }
    }
    
    /**
     * 批量更新用户数据
     */
    public function actionBatchUpdate(){
        $upload = UploadedFile::getInstanceByName('user-data');
        if($upload != null){
            $string = $upload->name;
            $excelutil = new ExcelUtil();
            $excelutil->load($upload->tempName);
            $columns = $excelutil->getSheetDataForRow()[0]['data'];
            
            //分析数据
            $users = $columns;
            $maxCount = count($users);
            $usernames = ArrayHelper::getColumn($users, 0);
            array_splice($usernames, 0, 1);
            array_splice($users, 0, 1);
            
            $db_users = User::find()
                    ->select(['username','nickname','sex'])
                    ->where(['username' => $usernames])
                    ->asArray()
                    ->all();
            $db_users = ArrayHelper::index($db_users, 'username');
            $rows = [];
            //去掉重复数据
            foreach($users as $index => &$user){
                $user[2] = $user[2] == '男' ? 1 : 2;
                if(!isset($db_users[$user[0]])){
                    $rows []= [rand(1,10000) + time(),$user[0],strtoupper(md5('123456')),$user[1],$user[2]];
                }
                $user[3] = isset($db_users[$user[0]]) ? 0 : 1;
            }
            if(count($rows) > 0){
                try{
                    \Yii::$app->db->createCommand()->batchInsert(User::tableName(), ['id','username','password','nickname','sex'], $rows)->execute();
                } catch (\Exception $ex) {
                    throw new HttpException('500','导入数据出错：'.$ex->getMessage());
                }
            }
            return $this->render('batch-update_result',['users' => $users]);
        }
        return $this->render('batch-update');
    }
    
    /**
     * 查找用户模型
     * @param integer $id   用户模型id
     * @return User 用户模型
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        if(($model = User::findOne(['id'=>$id])) !== null)
            return $model;
        else
            throw new NotFoundHttpException();
    }
}

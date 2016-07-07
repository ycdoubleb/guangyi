<?php

namespace wskeee\rbac\controllers;

use wskeee\rbac\models\AuthItem;
use wskeee\rbac\models\searchs\AuthItemSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rbac\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RoleController implements the CRUD actions for AuthItem model.
 */
class RoleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch(['type'=>  Item::TYPE_ROLE]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem(null);
        $model->type = Item::TYPE_ROLE;
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Yii::$app->authManager->remove($model->item);
        return $this->redirect(['index']);
    }
    
    /**
     * 分配/删除 角色/权限 
     * @param string $id 用户id
     * @param  string $action 动作 assigne添加，其它删除
     */
    public function actionAssign()
    {
        $authManager = \Yii::$app->authManager;
        $post = \Yii::$app->getRequest()->post();
        $id = $post['id'];
        $action = $post['action'];
        $items = $post['items'];
        $parent = $authManager->getRole($id);
        $error = [];
        
        foreach ($items as $item)
        {
            $child = $authManager->getRole($item);
            $child = $child ? : $authManager->getPermission($item);
            try {
                if($action === 'assign')
                    $authManager->addChild($parent, $child);
                else
                    $authManager->removeChild ($parent, $child);
            } catch (\Exception $ex) {
                $error[] = $ex->getMessage();
            }
        }
        
        Yii::$app->getResponse()->format = 'json';
        
        return [
            'type'=>'S',
            'errors'=>$error
        ];
    }
    
    /**
     * 查找 角色/权限
     * @param string $id        角色id
     * @param string $target    avaliable所有/assigned已分配
     * @param string $term      过滤字符
     */
    public function actionSearch($id,$target,$term='')
    {
        $autoManager = Yii::$app->authManager;
        $result = [
            'Roles'=>[],
            'Permissions'=>[]
        ];
        
        if($target === 'avaliable')
        {
            $children = array_keys($autoManager->getChildren($id));
            $children[] = $id;
            
            foreach ($autoManager->getRoles() as $name=>$role)
            {
                if(in_array($name, $children))
                    continue;
                if(empty($term) || strpos($name, $term)!==false)
                    $result['Roles'][$name] = $role;
            }
            foreach ($autoManager->getPermissions() as $name=>$role)
            {
                if(in_array($name, $children))
                    continue;
                if(empty($term) || strpos($name, $term)!==false)
                    $result['Permissions'][$name] = $role;
            }
        }else
        {
            foreach($autoManager->getChildren($id) as $name => $child)
            {
                if(empty($term) || strpos($name,$term) !== false)
                {
                    if($child->type == Item::TYPE_ROLE)
                        $result['Roles'][$name] = $child;
                    else
                        $result['Permissions'][$name] = $child;
                }
            }
        }
        Yii::$app->getResponse()->format = 'json';
        return array_filter($result);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $item = \Yii::$app->authManager->getRole($id);
        if($item !== null)
            return new AuthItem($item);
        else
            throw new NotFoundHttpException('The requested page does not exist.');
    }
}

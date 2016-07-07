<?php
namespace frontend\controllers;

use common\models\Banner;
use common\models\LoginForm;
use common\models\System;
use common\models\User;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use const YII_ENV_TEST;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private $auto_key = 'wskeee';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $system = System::find()->all();
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('index',[
            'system' => $system,
            'user' => $user,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        
        Yii::$app->getResponse()->format = "json";
        if (!\Yii::$app->user->isGuest && isset($post['username']) && $post['username'] === Yii::$app->user->identity->username) {
            return [
                'code'=>0,
                'message'=>'登录成功!',
                'userid'=>Yii::$app->user->id,
                'username'=>Yii::$app->user->identity->username,
                'authkey'=>md5(Yii::$app->user->identity->username.$model->password.$this->auto_key)
            ];
        }
        
        try
        {
            $post = Yii::$app->getRequest()->getQueryParams();
            $model = new LoginForm();
            $model->username = $post['username'];
            $model->password = $post['password'];
            
            if ($model->login()) {
                return [
                    'code'=>0,
                    'message'=>'登录成功!',
                    'userid'=>Yii::$app->user->id,
                    'username'=>Yii::$app->user->identity->username,
                    'authkey'=>md5(Yii::$app->user->identity->username.$model->password.$this->auto_key)
                ];
            } else {
                return [
                    'code'=>1,
                    'message'=>'登录失败! err：'.json_encode($model->getErrors())
                ];
            }
        } catch (\Exception $ex) {
            return [
                'code'=>3,
                'message'=>'登录失败! err:'.$ex->getMessage()
            ];
        }
    }
    
    /**
     * 自动登录 
     */
    public function actionAutoLogin()
    {
        Yii::$app->getResponse()->format = "json";
        $post = Yii::$app->getRequest()->getQueryParams();
        
        if (!\Yii::$app->user->isGuest && isset($post['username']) && $post['username'] === Yii::$app->user->identity->username) {
            return [
                'code'=>0,
                'message'=>'登录成功!',
                'userid'=>Yii::$app->user->id,
                'username'=>Yii::$app->user->identity->username,
                'authkey'=>md5($username.$model->password.$this->auto_key)
            ];
        }
        try
        {
            $autokey = isset($post['autokey']) ? $post['autokey'] : null;
            $username = isset($post['username']) ? $post['username'] : null;
            if($autokey && $username)
            {
                $model = User::findByUsername($username);
                if($model && md5($username.$model->password.'wskeee') === $this->auto_key)
                {
                    Yii::$app->user->login($model);
                    return [
                        'code'=>0,
                        'message'=>'登录成功!',
                        'userid'=>Yii::$app->user->id,
                        'username'=>Yii::$app->user->identity->username,
                        'authkey'=>$this->auto_key
                    ];
                }else
                {
                    return [
                        'code'=>3,
                        'message'=>'登录失败! err:'.$ex->getMessage()
                    ];
                }
            }
        } catch (\Exception $ex) {
            return [
                'code'=>3,
                'message'=>'登录失败! err:'.$ex->getMessage()
            ];
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return [
                'code'=>0,
                'message'=>'登出成功!'
            ];
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    /**
     * 修改我的属性
     *
     * @return mixed
     */
    public function actionResetInfo()
    {
        $model = User::findOne(Yii::$app->user->id);
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
            return $this->render('resetInfo',[
                'model' => $model,
            ]);
        }
    }
}

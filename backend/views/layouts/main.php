<?php

/* @var $this View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use kartik\dropdown\DropdownX;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => '首页', 
            'url' => [
                "/"
            ]
        ]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('rcoa', 'Login') , 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => '用户',
            'url' => ['/user'],
           // 'items' => [
                 //['label' => '用户', 'url' => '/user'],
                 //['label' => '角色', 'url' => '/rbac/role'],
                 //['label' => '权限', 'url' => '/rbac/permission'],
                 //['label' => '规则', 'url' => '/rbac/rule'],
           // ]
        ];
        $menuItems[] = [
            'label' => '学习情况',
            'url' => ['/guangyi'],
        ];
    }
    echo Nav::widget([
        'options' =>Yii::$app->user->isGuest ? ['class' =>'navbar-nav navbar-right'] : ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems,
    ]);
    if(!Yii::$app->user->isGuest){
        echo Html::beginTag('ul', ['class'=>'navbar-nav navbar-right nav']);
        echo '<li class="dropdown">'.Html::a(Html::img(WEB_ROOT . Yii::$app->user->identity->avatar,[
            'width'=> '30', 
            'height' => '30',
            'style' => 'border: 1px solid #ccc;margin-top:-13px; margin-right:5px;',
            ]).Yii::$app->user->identity->nickname.'<b class="caret"></b>','',[
                'class'=>'dropdown-toggle',
                'data-toggle' => 'dropdown',
                'aria-expanded' => 'false',
            ]).DropdownX::widget([
                'options'=>['class'=>'dropdown-menu'], // for a right aligned dropdown menu
                'items' => [
                    //['label' => '我的属性', 'url' => '/site/reset-info'],
                    ['label' => '登出', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ]).'</li>'; 
        echo Html::endTag('ul');
    }
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

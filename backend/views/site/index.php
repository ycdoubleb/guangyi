<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$this->title = '后台管理';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>后台管理</h1>

        <p class="lead">欢迎来到虚拟实验</p>
        <p class="lead">e170光化学反应仪</p>
        <?=
            Html::a('学习情况', Url::to(['/guangyi']), ['class' => 'btn btn-lg btn-success']);
        ?>
    </div>

    <div class="body-content">

    </div>
</div>

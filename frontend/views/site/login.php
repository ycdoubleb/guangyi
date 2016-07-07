<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>请填写以下字段以登录：</p>
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->label('用户名') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('密码') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox()->label('自动登录') ?>

                    <div style="color:#999;margin:1em 0">
                       如果你忘记密码，你可以通过 <?= Html::a('重置密码', ['site/request-password-reset']) ?> 按钮重置它。.
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

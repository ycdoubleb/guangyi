<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
?>
<div class="user-update">

    <h1>更新用户</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use common\models\course\Course;
use common\models\course\searchs\CourseSearch;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this View */
/* @var $searchModel CourseSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $model Course */

$this->title = '用户数据导入结果';
$right = '<span style="color:#0000ff">√</span>';
$wrong = '<span style="color:#ff0000">×（用户名重复）</span>';
$rightNum = 0;
foreach($users as $user){
    !$user[3] ? : $rightNum++;
}
?>
<div class="user-import-index">
    <h3><?= $this->title  ?></h3>
    <h4>共有<?= count($users) ?> 个用户需要导入，成功导入 <?= $rightNum ?> 个，失败<span style="color: #FF0000"><?= count($users) - $rightNum ?></span>个</h4>
    <?php if (count($users) > 0): ?>
        <table border="1" class="table table-striped table-bordered">
            <tr>
                <th></th>
                <th>用户名</th>
                <th>昵称</th>
                <th>性别</th>
                <th>结果</th>
            </tr>

            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?= $index ?></td>
                    <td><?= $user[0] ?></td>
                    <td><?= $user[1] ?></td>
                    <td><?= User::$sexName[$user[2]] ?></td>
                    <td><?= $user[3] ? $right : $wrong  ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <?= \yii\helpers\Html::a('返回','batch-update',['class' => 'btn btn-default']) ?>
</div>
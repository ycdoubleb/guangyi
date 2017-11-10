<?php

use common\models\course\Course;
use common\models\course\searchs\CourseSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $searchModel CourseSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $model Course */

$this->title = '用户数据导入';
?>
<div class="user-import-index">

    <?php ActiveForm::begin([
         'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>
    <div class="form-group">
        <label class='control-label'>选择要导入的表格：</label>
        <?= Html::input('file', 'user-data') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
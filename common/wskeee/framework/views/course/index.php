<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel wskeee\framework\models\searchs\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加课程', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'parent.parent.name',
                'label' => '所属项目',
                'headerOptions' => ['class'=>'col-lg-4']
            ],
            [
                'attribute' => 'parent.name',
                'label' => '所属子项目',
                'headerOptions' => ['class'=>'col-lg-4']
            ],
            'des',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

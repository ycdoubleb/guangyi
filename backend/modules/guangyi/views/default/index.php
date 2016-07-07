<?php

use backend\modules\guangyi\assets\GuangyiAsset;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

?>
<div class="guangyi-default-index">
    <h1>所有学员</h1>
     <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
    <div id="chartcanvas" style="width: 600px;height:400px;"></div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns'=>[
            [
                'attribute'=>'nickname',
                'label'=>'名称'
            ],
            [
                'attribute'=>'total',
                'label'=>'考核总数'
            ],
            [
                'attribute'=>'rightTotal',
                'label'=>'答对数'
            ],
            [
                'attribute'=>'pcorrect',
                'label'=>'正确率',
                'value'=>function($model){
                    return ((int)($model['pcorrect']*10000)/100).'%';
                }
            ],
            ['class' => 'yii\grid\ActionColumn','header'=>'操作','template' => '{view}',
                'buttons' => [
                'view' => function ($url, $model, $key) {
                      return  Html::a('<span class="btn btn-primary">查看</span>', $url, ['title' => '查看'] ) ;
                     },
                ],
               'headerOptions' => ['width' => '60']
            ],
        ]
    ])?>
</div>
<?php
    GuangyiAsset::register($this);
    $jsstep = json_encode($steps);
    $js = <<<JS
    var chart = new guangyi.IndexMain();
    chart.init(document.getElementById('chartcanvas'));        
    chart.reflashChart($jsstep);  
JS;
    $this->registerJs($js,  View::POS_READY); 
?>


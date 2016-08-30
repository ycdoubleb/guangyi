<?php

use backend\modules\guangyi\assets\GuangyiAsset;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

?>
<div class="guangyi-default-index">
    <h1>所有学员</h1>
     <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
    <div id="chartcanvas" style="width: 600px;height:400px;"></div>
    <h4><p style="font-family: 微软雅黑"><b>统计考核次数</b></p></h4>
    <a class="btn btn-lg btn-success" href="/guangyi/default/export">导出成绩</a>
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
                      return  Html::a('<span class="btn btn-primary">查看</span>', Url::to(['view','uid'=>$model['uid']]), ['title' => '查看'] ) ;
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
    chart.reflashChart('统计出错步骤',$jsstep);  
JS;
    $this->registerJs($js,  View::POS_READY); 
?>


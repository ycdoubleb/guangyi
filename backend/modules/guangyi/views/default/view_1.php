<?php

use backend\modules\guangyi\assets\GuangyiAsset;
use yii\grid\GridView;
use yii\web\View;

?>
<div class="guangyi-default-index">
    <h1>所有学员</h1>
     <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
    <div id="chartcanvas" style="width: 600px;height:400px;"></div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'=>[
            [
                'attribute'=>'nickname',
                'label'=>'名称',
                'headerOptions' => ['width' => '100']
            ],
            [
                'class' => 'backend\modules\guangyi\components\StepDataColumn',
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


<?php

use backend\modules\guangyi\assets\GuangyiAsset;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

?>
<div class="guangyi-default-index">
    <h1>学员：<?= $user->nickname ?></h1>
     <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
    <div id="chartcanvas" style="width: 600px;height:400px;"></div>
    <h4><p style="font-family: 微软雅黑"><b>环节进度</b></p></h4>
    <div class="study-progress">
        <?php
            $progress = $progress !== 'null' ? $progress : [];
            
            $studyProgress = [0,0,0,0,0];
            $itemNames = ['设置</br>介绍','工作</br>流程Ⅰ','工作</br>流程Ⅱ','模拟</br>练习','操作</br>考核'];
           
            foreach($progress as $ke=>$value)
                $studyProgress[$ke] = (int)$value;
            
            for($i=0,$len =count($studyProgress);$i<$len;$i++){
                echo Html::tag('div', 
                        Html::tag('div', '',['class'=>'tile '.(($i==0 || $studyProgress[$i-1]) ? 'tile-enabled':"tile-disabled")]).
                        Html::tag('span', $itemNames[$i] ,['class'=>'txt']).
                        Html::tag('span', '',['class'=>'locked '.(($i==0 || $studyProgress[$i-1]) ? 'hide':"")])
                        ,['class'=>'item']);
            }
            
            
        ?>
        <span class="mouse"></span>
    </div>
    <h4><p style="font-family: 微软雅黑"><b>考核详细</b></p></h4>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'=>[
            [
                'attribute'=>'created_at',
                'label'=>'时间',
                'format'=>'raw',
                'headerOptions' => ['width' => '100'],
                'value'=>function($model){
                    return Html::tag('div'
                            ,Html::tag('span','',['class'=>'rw '.($model['result']==1 ? 'right':'wrong')]).date('Y/m/d h:i:s',$model["created_at"])
                            ,['class'=>'access']);
                }
                
            ],
            [
                'class' => 'backend\modules\guangyi\components\StepDataColumn',
                'label' => '过程'
            ],
        ]
    ])?>
    <div class="substep-tooptip">
        <span class="txt">提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示提示</span>
    </div>
</div>
<?php
    GuangyiAsset::register($this);
    $jsstep = json_encode($steps);
    $js = <<<JS
    var chart = new guangyi.IndexMain();
    chart.init(document.getElementById('chartcanvas'));        
    chart.reflashChart('统计出错步骤',$jsstep);  
    
    $('.icon').hover(function(){
        var subdata = $.parseJSON($(this).attr('data'));
        if(subdata){
            $('.substep-tooptip .txt').html(replace(subdata));
            $('.substep-tooptip').css({'left':$(this).offset().left-(100)+'px','top':$(this).offset().top-278+'px'});
            $('.substep-tooptip').stop();
            $('.substep-tooptip').fadeIn();
        }
    },function(){
        $('.substep-tooptip').stop();
        $('.substep-tooptip').fadeOut();
    });
    function replace(data){
        var str = data.subtiptool;
        var data = data.data;
        var value;
        if(data)
        {
            for(var i in data)
            {
                value = data[i];
                if(i == "timer")
                    value = getTimerStr(Number(value));
                str = str.replace("{"+i+"}",value);
            }
            return str;
        }
    }
    
    /**
    * 获取时间 
    * @param value
    * @return 
    * 
    */
   function getTimerStr(value)
   {
           var h = Number(value/3600);
           var m = Number(value%3600/60);
           var s = Number(value%60);

           var str = "";
           if(h!=0 && h>1)
                   str += h+"小时";
           if(m!=0&& m>1)
                   str += m+"分钟";
           if(s!=0)
                   str += s+"秒";
           return str;
   }
JS;
    $this->registerJs($js,  View::POS_READY); 
?>


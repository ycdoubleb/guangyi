<?php

use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$jobManager = Yii::$app->get('jobManager');
$unReadyNotice = $jobManager->getUnReadyNotification(Yii::$app->user->id);
?>
<span class="badge badge-warning">7</span>
<ul class="dropdown-menu extended notification">
    <li>
        <p id="text">你总有7个通知</p>
    </li>
    <li>
        <p>【拍摄】</p>
    </li>
    <?php 
        foreach ($unReadyNotice as $unReadyNoticeKey=>$unReadyNoticeValue) {
            if($unReadyNoticeKey > 1) continue;
            foreach ($unReadyNoticeValue as $value) {
                echo '<li>';
                echo Html::a('<span>【'.$value->status.'】</span>'.$value->subject, [$value->link]);
                echo '</li>';
            }
        }
    ?>
    
    <li>
        <p>【多媒体制作】</p>
    </li>
    <li>
        <a href="#">
            <span>【制作中】</span>
            Database overloaded 24%.
        </a>
    </li>
    <li>
        <a href="#">
           <span>【制作中】</span>
            Database overloaded 24%.
        </a>
    </li>
    <li>
        <a href="#">
            <span>【制作中】</span>
            Database overloaded 24%.
        </a>
    </li>
    <li>
        <a href="#" style="text-align: center">全部清除</a>
    </li>
</ul>
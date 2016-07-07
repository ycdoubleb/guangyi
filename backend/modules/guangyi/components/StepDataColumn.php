<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\modules\guangyi\components;

use yii\grid\DataColumn;
use yii\helpers\Html;

/**
 * Description of StepDataColumn
 *
 * @author Administrator
 */
class StepDataColumn extends DataColumn{
    
    public function init() {
        parent::init();
        $this->format = 'raw';
    }
    
    public function getDataCellValue($model, $key, $index)
    {
        $icon = Html::tag('div','',['class'=>'icon icon0']);
        $name = Html::tag('span','何阳超(队长)',['class'=>'name']);
        $rw = Html::tag('div','',['class'=>'rw wrong']);
        
        $steps = '';
        
        for($i=0,$len=17;$i<$len;$i++){
            $steps.=Html::tag('div', $icon.$name.$rw, ['class'=>'step']);
        }
        
        return $steps;
    }
}

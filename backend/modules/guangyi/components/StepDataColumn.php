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
        $names = ['开机','关机','放试剂','放耗材','定标品稀释静置','质控品稀释静置','标本离心','把定标品放入进仓口',
            '启动START (做定标)','把质控品放入进仓口','启动START (做质控)','把标本放入进仓口','启动START (做标本)','发报告','STOP仪器','设备维护','清理试剂'];
        
        $data = json_decode($model['data'],true);
        $steps = '';
        
        for($i=0,$len=17;$i<$len;$i++){
            $item = isset($data[$i]) ? $data[$i] : null;
            $icon = Html::tag('div','',['class'=>'icon '.($item?'icon'.$item['trainId']:'bg'),'data'=>($item?json_encode($item['substepdata']):"null")]);
            $name = Html::tag('span',$item?$names[$item['trainId']]:"",['class'=>'name']);
            $rw = Html::tag('div','',['class'=>'rw '.($item?($item['pass']?'right':'wrong'):"")]);
            $steps.=Html::tag('div', $icon.$name.$rw, ['class'=>'step']);

            if($i!=$len-1)
                $steps.=Html::tag('div', '', ['class'=>'arrow']);
        }
        
        return $steps;
    }
}

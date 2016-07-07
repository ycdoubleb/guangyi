<?php
namespace backend\modules\guangyi\assets;

use yii\web\AssetBundle;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuangyiAsset
 *
 * @author Administrator
 */
class GuangyiAsset extends AssetBundle{
    //put your code here
    public $sourcePath = '@backend/modules/guangyi/assets';
    public $publishOptions = [
        'forceCopy'=>YII_DEBUG
    ];  
    public $css = [
       'css/indexmain.css'
    ];
    public $js = [
        'js/echarts.min.js',
        'js/indexmain.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}

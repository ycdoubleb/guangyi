<?php

use frontend\views\SiteAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/*has-title*/
$this->title = '';
?>
<div class="container site-index  site-list" style="padding-top: 15px;">
    
    
    <div class="body-content">
        <div class="download-box">
			<a class="download-btn" href="app/guangyi_v.0.0.3.zip">
				<div>
					<image src="css/imgs/64x64.png"/>
					<p>全包下载</p>
				</div>
			</a>
			<a class="download-btn" href="app/update/update201901011021.zip">
				<div>
					<image src="css/imgs/update.png"/>
					<p>更新包下载</p>
				</div>
			</a>
		</div>
    </div>
</div>
<?php  
 $js =   
<<<JS
    
JS;
    //$this->registerJs($js,  View::POS_READY); 
?> 


<?php
    SiteAsset::register($this);
?>
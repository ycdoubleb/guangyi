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
        <h1>这里什么都没有！</h1>
    </div>
</div>
<?php  
 $js =   
<<<JS
    $('.carousel').carousel({
        interval: 3000
    });
    var item = $('.carousel .item')[0];
    if(item.firstChild.localName == 'video'){
        item.firstChild.play();
        item.lastChild.onplaying = function(){
            $('.carousel').carousel('pause');
        }
        item.lastChild.onended = function(){
            $('.carousel').carousel({
                interval: 2000
            });
        }
    }
    $('#carousel-451276').on('slid.bs.carousel', function () {
       var item = $('.carousel .item');
        $(".item").each(function(i,item) {
            if(item.firstChild.localName == "video" && item.className == 'item active' ){
                item.firstChild.play();
                item.firstChild.onplaying = function(){
                    $('.carousel').carousel('pause');
                }
                item.firstChild.onended = function(){
                    $('.carousel').carousel({
                        interval: 2000
                    });
                }
            }
        });
    });
JS;
    //$this->registerJs($js,  View::POS_READY); 
?> 


<?php
    SiteAsset::register($this);
?>
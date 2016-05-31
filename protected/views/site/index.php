<div class="list-items">
    <?php 
        if($models){
            foreach($models as $model){ ?>
                <div class="items">
                    <a href="">
                        <span class="item-title"></span>
                        <div class="item-img">
                            <img src="<?php echo Yii::app()->baseUrl;?>/static/images/products/thumbs/<?php echo $model->image;?>">
                        </div>
                    </a>
                </div><!--/ END Items-->
    <?php 
            }
        }
    ?>
</div><!--// END list items-->
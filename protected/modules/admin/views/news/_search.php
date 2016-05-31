<div class="search-form">
<?php $form=$this->beginWidget('CActiveForm', array(
    	'action'=>Yii::app()->createUrl($this->route),
    	'method'=>'get',
        'id'=>'actitles-form',
        'htmlOptions'=>array(
            'onkeypress' => 'if(event.keyCode == 13){ $(this).submit(); }',
        ),
    )); ?>
    <div class="row-fluid">
        <div class="span12">
            <?php echo $form->dropDownList($model, 'category_id', array('0'=>' -- Danh Mục -- ') + CHtml::listData(Categories::model()->findAll('status = 1 AND data_type=2'),'id','title'), array('onchange'=>'$("#articles-form").submit();','style'=>'margin: 10px 0;')) ?>
    		<?php echo $form->textField($model,'title',array('style'=>'width: 40%;margin: 10px 0;','placeholder'=>$model->getAttributeLabel('title'))); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>
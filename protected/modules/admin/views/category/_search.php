<div class="search-form">
<?php $form=$this->beginWidget('CActiveForm', array(
    	'action'=>Yii::app()->createUrl($this->route),
    	'method'=>'get',
        'id'=>'categories-form',
        'htmlOptions'=>array(
            'onkeypress' => 'if(event.keyCode == 13){ $(this).submit(); }',
        ),
    )); ?>
    <div class="row-fluid">
        <div class="span12">
            <?php echo $form->dropDownList($model, 'data_type', array('0'=>'-- Loại Danh Mục --') + Yii::app()->params['data_type'], array('onchange'=>'$("#categories-form").submit();','style'=>'margin: 10px 0;')) ?>
    		<?php echo $form->textField($model,'title',array('style'=>'width: 40%;margin: 10px 0;','placeholder'=>$model->getAttributeLabel('title'))); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>
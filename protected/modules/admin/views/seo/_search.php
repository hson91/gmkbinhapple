<div class="search-form">
<?php $form=$this->beginWidget('CActiveForm', array(
    	'action'=>Yii::app()->createUrl($this->route),
    	'method'=>'get',
        'id'=>'seos-form',
        'htmlOptions'=>array(
            'onkeypress' => 'if(event.keyCode == 13){ $(this).submit(); }',
        ),
    )); ?>
    <div class="row-fluid">
        <div class="span12">
    		<?php echo $form->textField($model,'link',array('style'=>'width: 40%;margin: 10px 0;','placeholder'=>$model->getAttributeLabel('title'))); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>
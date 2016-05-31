<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>
<?php     
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seo-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    )
)); ?>
    
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'link', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'link',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'link',array('class'=>'error')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'title', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'title',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'title',array('class'=>'error')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'meta_key', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textArea($model, 'meta_key', array('class'=>'txtare-form')); ?>
			<?php echo $form->error($model,'meta_key',array('class'=>'error')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'meta_desc', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textArea($model, 'meta_desc', array('class'=>'txtare-form')); ?>
			<?php echo $form->error($model,'meta_desc',array('class'=>'error')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label">&nbsp;</div>
		<div class="input">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo Mới' : 'Cập Nhật', array('class'=>'bnt-form')); ?>
			<?php echo CHtml::link(CHtml::button('Hủy', array('class'=>'bnt-form')), array('index')); ?>
		</div>
	</div>
    
<?php $this->endWidget(); ?>
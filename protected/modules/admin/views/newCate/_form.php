<?php
/* @var $this CategorysController */
/* @var $model Categorys */
/* @var $form CActiveForm */
?>

<?php     
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    )
)); ?>
    
	<div class="controls">

		<div class="label"><?php echo $form->labelEx($model,'title', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'title',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'title',array('class'=>'error')); ?>
		</div>
	</div>
	
	<div class="controls">

		<div class="label"><?php echo $form->labelEx($model,'alias', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'alias',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'alias',array('class'=>'error')); ?>
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
<?php 
	$this->widget('ext.alias.Alias', array(
		'model'=>$model,
	));   
?>
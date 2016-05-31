<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        
    )
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php if (Yii::app()->user->role==='admin') : ?>
<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'username', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'username',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'username',array('class'=>'error'));?>
	</div>
</div>
<?php endif ?>

<?php if ($model->isNewRecord) : ?>
<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'password', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->passwordField($model,'password',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'password',array('class'=>'error'));?>
	</div>
</div>
<?php endif ?>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'first_name', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'first_name',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'first_name',array('class'=>'error'));?>
	</div>
</div>
<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'last_name', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'last_name',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'last_name',array('class'=>'error'));?>
	</div>
</div>
<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'email', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'email',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'email',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'address', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textArea($model,'address', array('class'=>'txtare-form')); ?>
		<?php echo $form->error($model,'address',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'phone', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'phone',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'phone',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'gender', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->dropDownList($model,'gender', Yii::app()->params['gender'], array('class'=>' sel-form')); ?>
		<?php echo $form->error($model,'gender',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'status', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->dropDownList($model,'status', Yii::app()->params['status'], array('class'=>' sel-form')); ?>
		<?php echo $form->error($model,'status',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label">&nbsp;</div>
	<div class="input">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo Mới' : 'Lưu', array('class'=>'bnt-form')); ?>
		<?php echo CHtml::link(CHtml::button('Hủy', array('class'=>'bnt-form')), array('index')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

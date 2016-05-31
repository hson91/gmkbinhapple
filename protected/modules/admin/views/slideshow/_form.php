<?php
/* @var $this PostsController */
/* @var $model Posts */
/* @var $form CActiveForm */
?>
<?php     
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    )
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'title', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'title',array('class'=>'txt-form')); ?>
		<?php echo $form->error($model,'title',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'link', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		<?php echo $form->textField($model,'link',array('class'=>'txt-form','style'=>'margin-bottom:10px;')); ?>
		<?php echo $form->error($model,'link',array('class'=>'error'));?>
	</div>
</div>

<div class="controls">
	<div class="label"><?php echo $form->labelEx($model,'image', array('class'=>'lbl-form')); ?></div>
	<div class="input">
		 <div class="uploader hover">
			<?php echo $form->fileField($model, 'image', array('class'=>'input-file uniform_on')); ?>
			<?php echo $form->error($model,'image',array('class'=>'error'));?>
		</div>
		<?php if ($model->image != '') : ?>
			<?php if (file_exists(Yii::app()->basePath.'/../data/images/slideshow/'.$model->image)) : ?>
				<?php echo CHtml::image(Yii::app()->baseUrl.'/data/images/slideshow/'.$model->image, $model->title, array('style'=>'width: 100px; vertical-align: top; margin: 5px 0;')); ?>
			<?php endif ?>
		<?php endif ?>
	</div>
</div>

<div class="controls">
	<div class="label">&nbsp;</div>
	<div class="input">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo Mới' : 'Lưu', array('class'=>'bnt-form')); ?>
		<?php echo CHtml::link(CHtml::button('Hủy', array('class'=>'bnt-form')), array('config/index')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
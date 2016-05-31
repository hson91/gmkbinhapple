<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>
<?php     
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'enctype'=>'multipart/form-data',
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
		<div class="label"><?php echo $form->labelEx($model,'var', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'var',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'var',array('class'=>'error')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'config_type', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->dropDownList($model,'config_type', Yii::app()->params['configs.type'],array('class'=>'sel-form')); ?>
			<?php echo $form->error($model,'config_type',array('class'=>'error')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'content', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'content',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'content',array('class'=>'error')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'html_content', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php $this->widget('ext.ckeditor.CKEditor', array('model'=>$model,'attribute'=>'html_content')); ?>
			<?php echo $form->error($model,'html_content',array('class'=>'error')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'image', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->fileField($model, 'image', array('class'=>'file-form')); ?>
			<?php echo $form->error($model,'image',array('class'=>'error'));?>
			
			<?php if ($model->image != '') : ?>
				<?php if (file_exists(Yii::app()->basePath.'/../data/images/config/'.$model->image)) : ?>
					<?php echo CHtml::image(Yii::app()->baseUrl.'/data/images/config/'.$model->image, $model->title, array('style'=>'width: 100px; vertical-align: top; margin: 5px 0;')); ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'link', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'link',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'link',array('class'=>'error')); ?>
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
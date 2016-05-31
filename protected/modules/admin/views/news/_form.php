<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<?php     
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
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
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'alias', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'alias',array('class'=>'txt-form')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'image', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->fileField($model, 'image', array('class'=>'file-form')); ?>
			<?php echo $form->error($model,'image',array('class'=>'error'));?>
			
			<?php if ($model->image != '') : ?>
				<?php if (file_exists(Yii::app()->basePath.'/../static/images/news/thumbs/'.$model->image)) : ?>
					<?php echo CHtml::image(Yii::app()->baseUrl.'/static/images/news/thumbs/'.$model->image, $model->title, array('style'=>'width: 100px; vertical-align: top; margin: 5px 0;')); ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'cate_id', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->dropDownList($model,'cate_id',array('0'=>'-- Danh Mục --')+CHtml::listData(NewCate::model()->findAll(),'id','title'),array('class'=>'sel-form')); ?>            
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'summary', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textArea($model, 'summary', array('class'=>'txtare-form')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'xmlrpc_parse_method_descriptions(xml)', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php $this->widget('ext.ckeditor.CKEditor', array('model'=>$model,'attribute'=>'description')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'meta_key', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textArea($model, 'meta_key', array('class'=>'txtare-form')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'meta_desc', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textArea($model, 'meta_desc', array('class'=>'txtare-form')); ?>
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
<?php 
	$this->widget('ext.alias.Alias', array(
		'model'=>$model,
	));   
?>
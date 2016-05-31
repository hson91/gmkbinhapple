<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<?php     
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
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
		<div class="label"><?php echo $form->labelEx($model,'alias', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'alias',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'alias',array('class'=>'error')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'image', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->fileField($model, 'image', array('class'=>'file-form')); ?>
			<?php echo $form->error($model,'image',array('class'=>'error'));?>
			
			<?php if ($model->image != '') : ?>
				<?php if (file_exists(Yii::app()->basePath.'/../static/images/products/thumbs/'.$model->image)) : ?>
					<?php echo CHtml::image(Yii::app()->baseUrl.'/static/images/products/thumbs/'.$model->image, $model->title, array('style'=>'width: 250px; vertical-align: top; margin: 5px 0;')); ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'category_id', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->dropDownList($model,'category_id',array('0'=>'-- Danh Mục --')+CHtml::listData(Category::model()->findAll('status = 1'),'id','title'),array('class'=>'sel-form')); ?>
			<?php echo $form->error($model,'category_id',array('class'=>'error')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'prices', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'prices',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'prices',array('class'=>'error')); ?>
		</div>
	</div>
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'promotion', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->textField($model,'promotion',array('class'=>'txt-form')); ?>
			<?php echo $form->error($model,'promotion',array('class'=>'error')); ?>
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
		<div class="label"><?php echo $form->labelEx($model,'status', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->dropDownList($model,'status', Yii::app()->params['status'],array('class'=>'sel-form')); ?>
		</div>
	</div>
	
	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'is_new', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->dropDownList($model,'is_new', Yii::app()->params['status'],array('class'=>'sel-form')); ?>
		</div>
	</div>

	<div class="controls">
		<div class="label"><?php echo $form->labelEx($model,'is_hot', array('class'=>'lbl-form')); ?></div>
		<div class="input">
			<?php echo $form->dropDownList($model,'is_hot', Yii::app()->params['status'],array('class'=>'sel-form')); ?>
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
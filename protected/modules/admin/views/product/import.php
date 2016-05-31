<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="icon-edit"></i><span class="break"></span>Import Questions Data</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content">
            <?php if (Yii::app()->user->hasFlash('import.success')) : ?>
            <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong> <?php echo Yii::app()->user->getFlash('import.questions.success') ?>.
			</div>
            <?php endif ?>
            <?php
                $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'import-products-form',
                	'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                        'class'=>'form-horizontal',
                        'enctype'=>'multipart/form-data',
                    )
                )
            ); ?>
                <?php echo $form->errorSummary($model); ?>
                
                <fieldset>
                    
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'excel', array('class'=>'control-label')); ?></dt>
                        <div class="controls">
                            <div class="uploader hover">
                            <?php echo $form->fileField($model,'excel', array('class'=>'input-file uniform_on')); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'zip', array('class'=>'control-label')); ?></dt>
                        <div class="controls">
                            <div class="uploader hover">
                            <?php echo $form->fileField($model,'zip', array('class'=>'input-file uniform_on')); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <?php echo CHtml::submitButton('Import', array('class'=>'btn btn-primary')); ?>
                        <?php echo CHtml::link(CHtml::button('Export File Mẫu', array('class'=>'btn btn-primary')), array('exportTemplate'), array('target'=>'helperFrame')); ?>
                        <?php echo CHtml::link(CHtml::button('Cancel', array('class'=>'btn btn-primary')), array('index')); ?>
                    </div>
                </fieldset>
            <?php $this->endWidget(); ?>   
        </div>
    </div>
</div>
<iframe src="" style="display:none" name="helperFrame"></iframe>
<hr />
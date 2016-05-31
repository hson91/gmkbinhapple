<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profiles-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array('class'=>'table'),
)); ?>
    <?php if(Yii::app()->user->hasFlash('profiles')) : ?>
    <div class="alert alert-success">
        <?php if(Yii::app()->user->hasFlash('profiles')) echo Yii::app()->user->getFlash('profiles'); ?>
    </div>
    <?php endif ?>
    <?php if(Yii::app()->user->hasFlash('change')) : ?>
    <div class="alert alert-success">
        <?php if(Yii::app()->user->hasFlash('change')) echo Yii::app()->user->getFlash('change'); ?>
    </div>
    <?php endif ?>
    
    <?php if(Yii::app()->user->hasFlash('error')) : ?>
    <div class="alert alert-error">
        <?php if(Yii::app()->user->hasFlash('error')) echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <?php endif ?>
    
    <div class="input">
        <?php echo $form->textField($model,'first_name', array('placeholder'=>$model->getAttributeLabel('first_name'))); ?>
    </div>
    <div class="input">
        <?php echo $form->textField($model,'last_name', array('placeholder'=>$model->getAttributeLabel('last_name'))); ?>
    </div>
    <div class="input">
        <?php echo CHtml::passwordField('old_password', '',array('placeholder'=>$model->getAttributeLabel('old_password'))); ?>
    </div>
    <div class="input">
        <?php echo CHtml::passwordField('new_password', '', array('placeholder'=>$model->getAttributeLabel('new_password'))); ?>
    </div>
    <div class="input">
        <?php echo CHtml::passwordField('confirm_password', '', array('placeholder'=>$model->getAttributeLabel('confirm_password'))); ?>
    </div>
    <div class="input">
        <?php echo $form->textField($model,'email', array('placeholder'=>$model->getAttributeLabel('email'))); ?>
    </div>
    <div class="input">
        <?php echo $form->textField($model,'phone', array('placeholder'=>$model->getAttributeLabel('phone'))); ?>
    </div>
    <div class="input">
        <?php echo $form->textField($model,'address', array('placeholder'=>$model->getAttributeLabel('address'))); ?>
    </div>
    
    <div class="input submit">
        <a href="<?=Yii::app()->baseUrl?>/admin" style="text-decoration: none;margin-right: 10px;">
            Back
        </a>
        <input type="submit" name="update" value="Save Change" />
    </div>
<?php $this->endWidget(); ?>
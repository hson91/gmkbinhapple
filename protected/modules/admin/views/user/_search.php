<div class="search-form">
<?php $form=$this->beginWidget('CActiveForm', array(
    	'action'=>Yii::app()->createUrl($this->route),
    	'method'=>'get',
        'htmlOptions'=>array(
            'onkeypress' => 'if(event.keyCode == 13){ $(this).submit(); }',
        ),
    )); ?>
    <div class="row-fluid">
        <div class="span12">
    		<?php echo $form->textField($model,'username',array('style'=>'width: 40%;margin: 10px 0;','placeholder'=>$model->getAttributeLabel('username'))); ?>
    		<?php echo $form->textField($model,'status',array('style'=>'width: 10%;margin: 10px 0;', 'placeholder'=>$model->getAttributeLabel('status'))); ?>
            <button class="btn btn-small btn-inverse" type="submit" style="height: 30px;min-width: 80px;">Search</button>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>
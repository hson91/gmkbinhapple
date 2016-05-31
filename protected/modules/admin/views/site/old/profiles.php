<script>
    jQuery(document).ready(function(){
        var tab = location.href.substring(location.href.indexOf('#'));
        if ($(tab).size()) {
            $('#myTab a[href='+tab+']').tab('show');    
        } else {
            $('#myTab a:first').tab('show');   
        }
    	$('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
    	});
    });
</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="row-fluid">
			<div class="login-box">
                <ul class="nav nav-tabs" id="myTab">
					<li class="active"><a href="#editprofile" data-toggle="tab">Edit Profile</a></li>
					<li><a href="#changepassword" data-toggle="tab">Change Password</a></li>
				</ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="editprofile">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                        	'id'=>'profiles-form',
                        	'enableClientValidation'=>true,
                        	'clientOptions'=>array(
                        		'validateOnSubmit'=>true,
                        	),
                            'htmlOptions'=>array('class'=>'table'),
                        )); ?>
                            <?php if(Yii::app()->user->hasFlash('profiles')) : ?>
                            <div class="box-content">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?php if(Yii::app()->user->hasFlash('profiles')) echo Yii::app()->user->getFlash('profiles'); ?>
                                </div>
                            </div>
                            <?php endif ?>
                            <fieldset>
                            <table cellspacing="0">
                                <div class="input-prepend" title="First Name">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'first_name', array('class'=>'input-large span10','placeholder'=>'First name')); ?>
                                </div>
                                <div class="input-prepend" title="Last Name">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'last_name', array('class'=>'input-large span10','placeholder'=>'Last name')); ?>
                                </div>
                                <div class="input-prepend" title="Email">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'email', array('class'=>'input-large span10','placeholder'=>'Email')); ?>
                                </div>
                                <div class="input-prepend" title="Phone">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'phone', array('class'=>'input-large span10','placeholder'=>'Phone')); ?>
                                </div>
                                <div class="input-prepend" title="Yahoo">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'yahoo', array('class'=>'input-large span10','placeholder'=>'Yahoo')); ?>
                                </div>
                                <div class="input-prepend" title="Skype">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'skype', array('class'=>'input-large span10','placeholder'=>'Skype')); ?>
                                </div>
                                <div class="input-prepend" title="Address">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo $form->textField($model,'address', array('class'=>'input-large span10','placeholder'=>'Address')); ?>
                                </div>
                                
                                <div class="button-login">
                                    <?php echo CHtml::link('Back', array('site/'),array('class'=>'btn btn-primary')); ?>
                                    <button type="submit" name="update" class="btn btn-primary"><i class="icon-off icon-white"></i> Save Change</button>
                                </div>
                            </table>
                            </fieldset>
                        <?php $this->endWidget(); ?>
                    </div>
                    <div class="tab-pane" id="changepassword">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                        	'id'=>'password-form',
                        	'enableClientValidation'=>true,
                        	'clientOptions'=>array(
                        		'validateOnSubmit'=>true,
                        	),
                            'action'=>$this->createUrl('site/profiles').'#changepassword',
                            'htmlOptions'=>array('class'=>'table'),
                        )); ?>
                            <?php if(Yii::app()->user->hasFlash('change')) : ?>
                            <div class="box-content">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <?php if(Yii::app()->user->hasFlash('change')) echo Yii::app()->user->getFlash('change'); ?>
                            </div></div>
                            <?php endif ?>
                            
                            <?php if(Yii::app()->user->hasFlash('error')) : ?>
                            <div class="box-content">
                            <div class="alert alert-error">
                                <?php if(Yii::app()->user->hasFlash('error')) echo Yii::app()->user->getFlash('error'); ?>
                            </div></div>
                            <?php endif ?>
                            
                            <fieldset>
                                <div class="input-prepend" title="Password">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo CHtml::passwordField('old_password', '',array('class'=>'input-large span10','placeholder'=>'Password')); ?>
                                </div>
                                <div class="input-prepend" title="New Password">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo CHtml::passwordField('new_password', '', array('class'=>'input-large span10','placeholder'=>'New Password')); ?>
                                </div>
                                <div class="input-prepend" title="Confirm Password">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <?php echo CHtml::passwordField('confirm_password', '', array('class'=>'input-large span10','placeholder'=>'Confirm Password')); ?>
                                </div>
                                <div class="button-login">
                                    <?php echo CHtml::link('Back', array('site/'),array('class'=>'btn btn-primary')); ?>
                                    <button type="submit" name="change" class="btn btn-primary"><i class="icon-off icon-white"></i> Save Change</button>
                                </div>
                            </fieldset>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
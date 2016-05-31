<div class="container-fluid">
	<div class="row-fluid">
		<div class="row-fluid">
			<div class="login-box">
                <?php $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'login-form',
                	'enableClientValidation'=>true,
                	'clientOptions'=>array(
                		'validateOnSubmit'=>true,
                	),
                    'htmlOptions'=>array('class'=>'form-horizontal'),
                )); ?>
					<fieldset>
						<div class="input-prepend" title="Username">
							<span class="add-on"><i class="icon-user"></i></span>
                            <?php echo $form->textField($model,'username', array('class'=>'input-large span10','placeholder'=>'Username')); ?>
						</div>
						<div class="input-prepend" title="Password">
							<span class="add-on"><i class="icon-lock"></i></span>
							<?php echo $form->passwordField($model,'password', array('class'=>'input-large span10','placeholder'=>'Password')); ?>
						</div>
						<div class="button-login">	
							<button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
						</div>
                    </fieldset>
                <?php $this->endWidget(); ?>
			</div><!--/span-->
		</div><!--/row-->
	</div><!--/fluid-row-->
</div><!--/.fluid-container-->
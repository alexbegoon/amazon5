<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1 class="text-center"><?php echo UserModule::t("Registration"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="alert alert-success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="container">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data','role'=>'form'),
)); ?>

	<p class="note alert alert-warning"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile), null, null, array('class'=>'alert alert-danger')); ?>
	
	<div class="row form-group">
	<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'username',array('class'=>'label label-danger')); ?>
	</div>
	
	<div class="row form-group">
	<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
	<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'password',array('class'=>'label label-danger')); ?>
	<p class="hint label label-primary">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row form-group">
	<?php echo $form->labelEx($model,'verifyPassword',array('class'=>'control-label')); ?>
	<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'verifyPassword',array('class'=>'label label-danger')); ?>
	</div>
	
	<div class="row form-group">
	<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
	</div>
	
<?php 
		$profileFields=Profile::getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row form-group">
		<?php echo $form->labelEx($profile,$field->varname,array('class'=>'control-label')); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range),array('class'=>'form-control'));
		} elseif ($field->field_type=="TEXT") {
			echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'form-control'));
		} else {
			echo $form->textField($profile,$field->varname,array('class'=>'form-control','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname,array('class'=>'label label-danger')); ?>
	</div>	
			<?php
			}
		}
?>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'verifyCode',array('class'=>'control-label')); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'verifyCode',array('class'=>'label label-danger')); ?>
		
		<p class="hint label label-primary"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register"),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
<?php endif; ?>
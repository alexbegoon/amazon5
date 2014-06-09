<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change password"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?>

<h1 class="text-center"><?php echo UserModule::t("Change password"); ?></h1>

<div class="container">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note alert alert-warning"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>
	
	<div class="row form-group">
	<?php echo $form->labelEx($model,'oldPassword',array('class'=>'control-label')); ?>
	<?php echo $form->passwordField($model,'oldPassword',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'oldPassword',array('class'=>'label label-danger')); ?>
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
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save"),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
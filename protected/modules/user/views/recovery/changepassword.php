<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change password"),
);
?>

<h1 class="text-center"><?php echo UserModule::t("Change password"); ?></h1>


<div class="container">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php echo CHtml::beginForm(); ?>

	<p class="note alert alert-warning"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($form, null, null, array('class'=>'alert alert-danger')); ?>
	
	<div class="row form-group">
	<?php echo CHtml::activeLabelEx($form,'password',array('class'=>'control-label')); ?>
	<?php echo CHtml::activePasswordField($form,'password',array('class'=>'form-control')); ?>
	<p class="hint label label-primary">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row form-group">
	<?php echo CHtml::activeLabelEx($form,'verifyPassword',array('class'=>'control-label')); ?>
	<?php echo CHtml::activePasswordField($form,'verifyPassword',array('class'=>'form-control')); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save"),array('class'=>'btn btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
</div>
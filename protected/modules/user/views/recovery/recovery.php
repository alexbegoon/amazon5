<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<h1 class="text-center"><?php echo UserModule::t("Restore"); ?></h1>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="alert alert-success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="container">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form, null, null, array('class'=>'alert alert-danger')); ?>
	
	<div class="row form-group">
		<?php echo CHtml::activeLabel($form,'login_or_email',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email',array('class'=>'form-control')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Restore"),array('class'=>'btn btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
    </div>
</div><!-- form -->
<?php endif; ?>
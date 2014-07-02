<?php
/* @var $this ProviderInvoicesController */
/* @var $model ProviderInvoices */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'provider-invoices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'provider_id',  CHtml::listData(Providers::model()->findAll(), 'id', 'provider_name'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'net_cost',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'net_cost',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'net_cost',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',  CHtml::listData(Currencies::model()->findAll(array('order'=>'currency_name','condition'=>'published = 1')), 'id', 'currency_name'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'paid',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'paid'); ?>
		<?php echo $form->error($model,'paid',array('class'=>'label label-danger')); ?>
	</div>

	
	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
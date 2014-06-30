<?php
/* @var $this ProvidersController */
/* @var $model Providers */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'providers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_name',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'cif',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'cif',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'cif',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_desc',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_desc',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_url',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_country',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'provider_country',CHtml::listData(Countries::model()->findAll(array('order'=>'name')), 'code', 'name'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_country',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_address',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_address',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_address',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_type',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'provider_type',enumItem($model,'provider_type'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_type',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'vat',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'vat',array('size'=>5,'maxlength'=>5,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'vat',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'inactive',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'inactive'); ?>
		<?php echo $form->error($model,'inactive',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'sku_format',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'sku_format',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sku_format',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'provider_email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_email',array('class'=>'label label-danger')); ?>
	</div>
    
	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
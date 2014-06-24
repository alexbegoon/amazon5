<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manufacturers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
	<p class="note alert alert-warning">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model, $manufacturerTranslations), null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($manufacturerTranslations,'manufacturer_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($manufacturerTranslations,'manufacturer_name',array('class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($manufacturerTranslations,'manufacturer_name',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($manufacturerTranslations,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($manufacturerTranslations,'language_code',CHtml::listData(Languages::model()->findAll(array('order'=>'title')),'lang_code','title'),array('class'=>'form-control')); ?>
		<?php echo $form->error($manufacturerTranslations,'language_code',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($manufacturerTranslations,'manufacturer_email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($manufacturerTranslations,'manufacturer_email',array('class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($manufacturerTranslations,'manufacturer_email',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($manufacturerTranslations,'manufacturer_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($manufacturerTranslations,'manufacturer_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($manufacturerTranslations,'manufacturer_desc',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($manufacturerTranslations,'manufacturer_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($manufacturerTranslations,'manufacturer_url',array('class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($manufacturerTranslations,'manufacturer_url',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($manufacturerTranslations,'slug',array('class'=>'control-label')); ?>
		<?php echo $form->textField($manufacturerTranslations,'slug',array('class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($manufacturerTranslations,'slug',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'created_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'created_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'created_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'created_by',array('class'=>'label label-danger')); ?>
	</div>-->

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'modified_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'modified_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'modified_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'modified_by',array('class'=>'label label-danger')); ?>
	</div>-->

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'locked_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'locked_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'locked_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'locked_by',array('class'=>'label label-danger')); ?>
	</div>-->

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
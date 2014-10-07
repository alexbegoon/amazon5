<?php
/* @var $this ShippingTypesController */
/* @var $model ShippingTypes */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shipping-types-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_type_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shipping_type_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_type_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_type_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'shipping_type_desc',array('maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_type_desc',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
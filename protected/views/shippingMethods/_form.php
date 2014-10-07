<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethods */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shipping-methods-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model,$shippingMethodTranslation), null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_company_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'shipping_company_id', ShippingCompanies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_company_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_type_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'shipping_type_id',ShippingTypes::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_type_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($shippingMethodTranslation,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($shippingMethodTranslation,'language_code',  Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($shippingMethodTranslation,'language_code',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($shippingMethodTranslation,'shipping_method_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($shippingMethodTranslation,'shipping_method_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($shippingMethodTranslation,'shipping_method_name',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($shippingMethodTranslation,'shipping_method_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($shippingMethodTranslation,'shipping_method_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($shippingMethodTranslation,'shipping_method_desc',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
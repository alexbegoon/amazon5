<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethodTranslations */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shipping-method-translations-_translations-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <?php echo $form->hiddenField($model,'shipping_method_id',array('class'=>'form-control')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'language_code',  Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'language_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_method_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shipping_method_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_method_name',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_method_title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shipping_method_title',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_method_title',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_method_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'shipping_method_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_method_desc',array('class'=>'label label-danger')); ?>
	</div>	

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
<?php
/* @var $this PostalCodesRangesController */
/* @var $model PostalCodesRanges */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'postal-codes-ranges-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'country_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'country_code',Countries::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'country_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'postal_code_from',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'postal_code_from',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'postal_code_from',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'postal_code_to',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'postal_code_to',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'postal_code_to',array('class'=>'label label-danger')); ?>
	</div>
    
        <div class="row form-group">
		<?php echo $form->labelEx($model,'range_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'range_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'range_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
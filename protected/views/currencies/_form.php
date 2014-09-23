<?php
/* @var $this CurrenciesController */
/* @var $model Currencies */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currencies-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_code_2',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_code_2',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_code_2',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_code_3',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_code_3',array('size'=>3,'maxlength'=>3,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_code_3',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_numeric_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_numeric_code',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_numeric_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_exchange_rate',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_exchange_rate',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_exchange_rate',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_symbol',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_symbol',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_symbol',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_decimal_place',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_decimal_place',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_decimal_place',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_decimal_symbol',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_decimal_symbol',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_decimal_symbol',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_thousands',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_thousands',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_thousands',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_positive_style',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_positive_style',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_positive_style',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_negative_style',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_negative_style',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_negative_style',array('class'=>'label label-danger')); ?>
	</div>

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
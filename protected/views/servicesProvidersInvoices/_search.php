<?php
/* @var $this ServicesProvidersInvoicesController */
/* @var $model ServicesProvidersInvoices */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-8 col-lg-3">
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row form-group">
		<?php echo $form->label($model,'id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'invoice_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'invoice_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'provider_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'paid',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'paid',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'net_cost',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'net_cost',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'invoice_date',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'invoice_date',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'due_date',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'due_date',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'file',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'file',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'created_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'created_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'modified_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'modified_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'locked_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'locked_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton(Yii::t('common','Search'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
</div>
<!-- search-form -->
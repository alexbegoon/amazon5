<?php
/* @var $this ProvidersController */
/* @var $model Providers */
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
		<?php echo $form->label($model,'provider_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_name',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'cif',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'cif',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'provider_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_desc',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'provider_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'provider_country',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_country',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'provider_address',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_address',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'vat',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'vat',array('size'=>5,'maxlength'=>5,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'inactive',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'inactive',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'sku_format',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'sku_format',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'provider_email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
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
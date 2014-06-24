<?php
/* @var $this CurrenciesController */
/* @var $model Currencies */
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
		<?php echo $form->label($model,'currency_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_code_2',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_code_2',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_code_3',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_code_3',array('size'=>3,'maxlength'=>3,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_numeric_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_numeric_code',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_exchange_rate',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_exchange_rate',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_symbol',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_symbol',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_decimal_place',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_decimal_place',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_decimal_symbol',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_decimal_symbol',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_thousands',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_thousands',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_positive_style',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_positive_style',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_negative_style',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_negative_style',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'published',array('class'=>'form-control')); ?>
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
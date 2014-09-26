<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */
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
		<?php echo $form->label($model,'status_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'status_code',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'status_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'status_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'status_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'status_desc',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'published',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'public',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'public',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'notify_customer_if_applied',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'notify_customer_if_applied',array('class'=>'form-control')); ?>
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
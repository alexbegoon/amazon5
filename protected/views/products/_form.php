<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_parent_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_parent_id',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_parent_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_sku',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_sku',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_sku',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'published',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'blocked',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'blocked',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'blocked',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'created_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'created_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'created_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'created_by',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'modified_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'modified_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'modified_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'modified_by',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'locked_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'locked_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'locked_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'locked_by',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
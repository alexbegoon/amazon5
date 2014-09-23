<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'states-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'country_code',array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model,'country_code',Countries::listData(),array('class'=>'form-control'));?>
		<?php echo $form->error($model,'country_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'state_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'state_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'state_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'state_3_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'state_3_code',array('size'=>3,'maxlength'=>3,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'state_3_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'state_2_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'state_2_code',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'state_2_code',array('class'=>'label label-danger')); ?>
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
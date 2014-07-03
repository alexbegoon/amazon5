<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manufacturers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model, $modelTranslation), null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($modelTranslation,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($modelTranslation,'language_code',Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($modelTranslation,'language_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($modelTranslation,'manufacturer_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($modelTranslation,'manufacturer_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($modelTranslation,'manufacturer_name',array('class'=>'label label-danger')); ?>
	</div>
    
	<div class="row form-group">
		<?php echo $form->labelEx($modelTranslation,'manufacturer_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($modelTranslation,'manufacturer_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($modelTranslation,'manufacturer_desc',array('class'=>'label label-danger')); ?>
	</div>
    
	<div class="row form-group">
		<?php echo $form->labelEx($model,'manufacturer_email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'manufacturer_email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'manufacturer_email',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'manufacturer_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'manufacturer_url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'manufacturer_url',array('class'=>'label label-danger')); ?>
	</div>
    
	<div class="row form-group">
		<?php echo $form->labelEx($modelTranslation,'slug',array('class'=>'control-label')); ?>
		<?php echo $form->textField($modelTranslation,'slug',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($modelTranslation,'slug',array('class'=>'label label-danger')); ?>
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
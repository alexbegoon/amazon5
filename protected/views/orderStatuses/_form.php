<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-statuses-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model,$orderStatusTranslations), null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'status_code',array('class'=>'control-label')); ?>
                <?php $this->widget('CMaskedTextField',array('htmlOptions'=>array('class'=>'form-control'),'mask'=>'aa','model'=>$model,'attribute'=>'status_code'))  ?>
		<?php echo $form->error($model,'status_code',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($orderStatusTranslations,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($orderStatusTranslations,'language_code',Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($orderStatusTranslations,'language_code',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($orderStatusTranslations,'status_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($orderStatusTranslations,'status_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($orderStatusTranslations,'status_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($orderStatusTranslations,'status_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($orderStatusTranslations,'status_desc',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($orderStatusTranslations,'status_desc',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'public',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'public'); ?>
		<?php echo $form->error($model,'public',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'notify_customer_if_applied',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'notify_customer_if_applied'); ?>
		<?php echo $form->error($model,'notify_customer_if_applied',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
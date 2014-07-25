<?php
/* @var $this WebShopsController */
/* @var $model WebShops */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-shops-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shop_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shop_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'shop_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shop_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shop_code',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'shop_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'template_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'template_name',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'template_name',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shop_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shop_url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'shop_url',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'default_language',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'default_language',Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'default_language',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'offline',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'offline'); ?>
		<?php echo $form->error($model,'offline',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'email_header',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'email_header',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email_header',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'email_footer',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'email_footer',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email_footer',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'email_subject',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'email_subject',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email_subject',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'admin_email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'admin_email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'admin_email',array('class'=>'label label-danger')); ?>
	</div>

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'created_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'created_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'created_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'created_by',array('class'=>'label label-danger')); ?>
	</div>-->

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'modified_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'modified_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'modified_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'modified_by',array('class'=>'label label-danger')); ?>
	</div>-->

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'locked_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_on',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'locked_on',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'locked_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_by',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'locked_by',array('class'=>'label label-danger')); ?>
	</div>-->

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
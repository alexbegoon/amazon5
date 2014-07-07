<?php
/* @var $this ProductTranslationsController */
/* @var $model ProductTranslations */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-translations-_translations-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <?php echo $form->hiddenField($model,'product_id',array('class'=>'form-control')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'language_code',  Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'language_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_name',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'product_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'product_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_desc',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_s_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'product_s_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_s_desc',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'meta_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'meta_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'meta_desc',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'meta_keywords',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'meta_keywords',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'meta_keywords',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'custom_title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'custom_title',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'custom_title',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'slug',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'slug',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'slug',array('class'=>'label label-danger')); ?>
	</div>

	

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
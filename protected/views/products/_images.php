<?php
/* @var $this ProductImagesController */
/* @var $model ProductImages */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-images-_images-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <?php echo $form->hiddenField($model,'product_id',array('class'=>'form-control')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'image',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		<?php echo $form->error($model,'image',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'image_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'image_url',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image_url',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'thumb_width',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'thumb_width',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'thumb_width',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'thumb_height',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'thumb_height',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'thumb_height',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'thumb_quality',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'thumb_quality', ProductImages::listQualities(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'thumb_quality',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
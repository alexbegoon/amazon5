<?php
/* @var $this CategoriesController */
/* @var $model CategoryImages */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-images-_images-form',
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

        <?php echo $form->hiddenField($model,'category_id',array('class'=>'form-control')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'image',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		<?php echo $form->error($model,'image',array('class'=>'label label-danger')); ?>
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
		<?php echo $form->dropDownList($model,'thumb_quality', CategoryImages::listQualities(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'thumb_quality',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
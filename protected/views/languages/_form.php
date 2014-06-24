<?php
/* @var $this LanguagesController */
/* @var $model Languages */
/* @var $form CActiveForm */
?>

<div class="container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
)); 

$image_url_list = CFileHelper::findFiles('imgs'.DIRECTORY_SEPARATOR.'flags');
$image_url_thumb_list = (CFileHelper::findFiles('imgs'.DIRECTORY_SEPARATOR.'small_flags'));

$image_url_list = array_combine($image_url_list, $image_url_list);
$image_url_thumb_list = array_combine($image_url_thumb_list, $image_url_thumb_list);

?>
        <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>
	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'lang_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'lang_code',array('size'=>5,'maxlength'=>5,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'lang_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'title_native',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'title_native',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title_native',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'sef',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'sef',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sef',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'image_url',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'image_url',$image_url_list,array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image_url',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'image_url_thumb',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'image_url_thumb',$image_url_thumb_list,array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image_url_thumb',array('class'=>'label label-danger')); ?>
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

</div><!-- form -->

<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatusTranslations */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'status-code-translations-_translations-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <?php echo $form->hiddenField($model,'status_code',array('class'=>'form-control')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'language_code',  Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'language_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'status_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'status_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status_name',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'status_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'status_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status_desc',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="note alert alert-warning">
            <?php echo Yii::t('common', 'Available the next aliases: {aliases}',
                    array('{aliases}'=>'<ul>'
                        . '<li>{customer_name}</li>'
                        . '<li>{order_number}</li>'
                        . '<li>{order_link}</li>'
                        . '<li>{status_name}</li>'
                        . '<li>{tracking_number}</li>'
                        . '<li>{support_email}</li>'
                        . '<li>{webshop_url}</li>'
                        . '</ul>'));?>
        </div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'email_subject_template',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'email_subject_template',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email_subject_template',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'email_body_template',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'email_body_template',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email_body_template',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $this->widget('TinyMCE',array('options'=>array(
    'selector'=>'#'.CHtml::activeId($model, 'email_body_template'),
))); ?>
</div>
</div>
</div><!-- form -->
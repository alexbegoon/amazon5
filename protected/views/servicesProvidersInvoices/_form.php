<?php
/* @var $this ServicesProvidersInvoicesController */
/* @var $model ServicesProvidersInvoices */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'services-providers-invoices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'provider_id',ServicesProviders::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_id',array('class'=>'label label-danger')); ?>
	</div>
    
	<div class="row form-group">
		<?php echo $form->labelEx($model,'invoice_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'invoice_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'invoice_number',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'net_cost',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'net_cost',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'net_cost',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'paid',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'paid'); ?>
		<?php echo $form->error($model,'paid',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'invoice_date',array('class'=>'control-label')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'ServicesProvidersInvoices[invoice_date]',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'dateFormat'=>'yy-mm-dd'
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                    ),
                    'language'=>  Yii::app()->language,
                ));
                ?>
		<?php echo $form->error($model,'invoice_date',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'due_date',array('class'=>'control-label')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'ServicesProvidersInvoices[due_date]',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'dateFormat'=>'yy-mm-dd'
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                    ),
                    'language'=>  Yii::app()->language,
                ));
                ?>
		<?php echo $form->error($model,'due_date',array('class'=>'label label-danger')); ?>
	</div>

<!--	<div class="row form-group">
		<?php echo $form->labelEx($model,'file',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'file',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'file',array('class'=>'label label-danger')); ?>
	</div>-->

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
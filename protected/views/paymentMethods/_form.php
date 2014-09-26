<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-methods-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model,$paymentMethodTranslation,$paypalParams,$tpvParams,$sagepayParams), null, null, array('class'=>'alert alert-danger')); ?>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'web_shop_id',WebShops::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($paymentMethodTranslation,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($paymentMethodTranslation,'language_code',  Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($paymentMethodTranslation,'language_code',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($paymentMethodTranslation,'payment_method_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($paymentMethodTranslation,'payment_method_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($paymentMethodTranslation,'payment_method_name',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($paymentMethodTranslation,'payment_method_title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($paymentMethodTranslation,'payment_method_title',array('class'=>'form-control')); ?>
		<?php echo $form->error($paymentMethodTranslation,'payment_method_title',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($paymentMethodTranslation,'payment_method_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($paymentMethodTranslation,'payment_method_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($paymentMethodTranslation,'payment_method_desc',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'handler_component',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'handler_component',enumItem($model,'handler_component'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'handler_component',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <?php $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            'Bank Transfer'=>array('content'=>Yii::t('common', 'Not configurable'), 'id'=>'BankTransfer'),
            'PayPal'=>array('content'=>$this->renderPartial('_paypal_params', array('paramsModel'=>$paypalParams,
                                                           'form'=>$form ), true), 'id'=>'PayPal'),
            'SagePay'=>array('content'=>$this->renderPartial('_sagepay_params', array('paramsModel'=>$sagepayParams,
                                                           'form'=>$form ), true), 'id'=>'SagePay'),
            'TPV'=>array('content'=>$this->renderPartial('_tpv_params', array('paramsModel'=>$tpvParams,
                                                           'form'=>$form ), true), 'id'=>'TPV'),
            
        ),
        'id'=>'params_tabs',
        'htmlOptions'=>array('class'=>'row form-group'),
        // additional javascript options for the tabs plugin
        'options'=>array(
            'collapsible'=>false,
            'disabled'=>true,
            'show'=>array(
                'effect'=>'blind',
                'duration'=>800,
            ),
        ),
));
        
        Yii::app()->clientScript->registerScript('tabs',"
                $(function(){ 
			init_tabs = function(){ 
				$('#params_tabs').tabs( 'option','disabled', true ); 
				var selectedTab = $('#PaymentMethods_handler_component').val().replace(/\s+/g, ''); 
				$('#params_tabs').tabs( 'enable', selectedTab);
				var index = $('#params_tabs a[href=#'+selectedTab+']').parent().index();
                                $('#params_tabs').tabs('select', index);
			}; 

			init_tabs(); 
			$('#PaymentMethods_handler_component').change(function(){
				init_tabs();
			});
		});
                ");
        ?>
        <hr>
	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $this->widget('TinyMCE',array('options'=>array(
    'selector'=>'textarea',
)));?>
</div>
</div>
</div>
<!-- form -->
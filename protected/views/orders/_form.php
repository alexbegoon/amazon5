<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <div class="row form-group">
		<?php echo $form->labelEx($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'web_shop_id',WebShops::listData(), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'language_code',Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'language_code',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'user_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'user_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'user_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_number',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_total',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_total',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_total',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_subtotal',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_subtotal',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_subtotal',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_tax',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_tax',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_tax',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_shipment',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_shipment',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_shipment',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_shipment_tax',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_shipment_tax',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_shipment_tax',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_payment',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_payment',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_payment',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_payment_tax',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_payment_tax',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_payment_tax',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_discount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_discount',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_discount',array('class'=>'label label-danger')); ?>
	</div>

	

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_coupon',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_coupon',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_coupon',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'payment_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'payment_method_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'payment_method_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shipping_method_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_method_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_outer_status',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_outer_status',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_outer_status',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_inner_status',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_inner_status',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_inner_status',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_tracking_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_tracking_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_tracking_number',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'order_coupon_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_coupon_code',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_coupon_code',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'manager_note',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'manager_note',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'manager_note',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'magnet_msg_sent',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'magnet_msg_sent'); ?>
		<?php echo $form->error($model,'magnet_msg_sent',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'deleted',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
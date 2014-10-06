<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-8 col-lg-3">
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row form-group">
		<?php echo $form->label($model,'id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'user_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'user_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_pass',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_pass',array('size'=>8,'maxlength'=>8,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_total',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_total',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_subtotal',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_subtotal',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_tax',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_tax',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_shipment',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_shipment',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_shipment_tax',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_shipment_tax',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_payment',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_payment',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_payment_tax',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_payment_tax',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_discount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_discount',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_coupon_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_coupon_code',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_coupon_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_coupon_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_coupon',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_coupon',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'currency_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'payment_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'payment_method_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'shipping_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shipping_method_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_outer_status',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_outer_status',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_inner_status',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_inner_status',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'order_tracking_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_tracking_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'customer_note',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'customer_note',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'manager_note',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'manager_note',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'ip_address',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'web_shop_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'user_profile_data',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'user_profile_data',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'language_code',array('size'=>5,'maxlength'=>5,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'magnet_msg_sent',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'magnet_msg_sent',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'w3c_order_date',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'w3c_order_date',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'created_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'created_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'modified_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'modified_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'locked_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'locked_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'locked_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'deleted',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'deleted',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'deleted_on',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'deleted_on',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'deleted_by',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'deleted_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton(Yii::t('common','Search'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
</div>
<!-- search-form -->
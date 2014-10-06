<?php
/* @var $this OrdersController */
/* @var $data Orders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_number')); ?>:</b>
	<?php echo CHtml::encode($data->order_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_pass')); ?>:</b>
	<?php echo CHtml::encode($data->order_pass); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_total')); ?>:</b>
	<?php echo CHtml::encode($data->order_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->order_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_tax')); ?>:</b>
	<?php echo CHtml::encode($data->order_tax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('order_shipment')); ?>:</b>
	<?php echo CHtml::encode($data->order_shipment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_shipment_tax')); ?>:</b>
	<?php echo CHtml::encode($data->order_shipment_tax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_payment')); ?>:</b>
	<?php echo CHtml::encode($data->order_payment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_payment_tax')); ?>:</b>
	<?php echo CHtml::encode($data->order_payment_tax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_discount')); ?>:</b>
	<?php echo CHtml::encode($data->order_discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_coupon_code')); ?>:</b>
	<?php echo CHtml::encode($data->order_coupon_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_coupon_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_coupon_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_coupon')); ?>:</b>
	<?php echo CHtml::encode($data->order_coupon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
	<?php echo CHtml::encode($data->currency_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_method_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_method_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_method_id')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_method_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_outer_status')); ?>:</b>
	<?php echo CHtml::encode($data->order_outer_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_inner_status')); ?>:</b>
	<?php echo CHtml::encode($data->order_inner_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_tracking_number')); ?>:</b>
	<?php echo CHtml::encode($data->order_tracking_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_note')); ?>:</b>
	<?php echo CHtml::encode($data->customer_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manager_note')); ?>:</b>
	<?php echo CHtml::encode($data->manager_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->ip_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_shop_id')); ?>:</b>
	<?php echo CHtml::encode($data->web_shop_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_profile_data')); ?>:</b>
	<?php echo CHtml::encode($data->user_profile_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language_code')); ?>:</b>
	<?php echo CHtml::encode($data->language_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('magnet_msg_sent')); ?>:</b>
	<?php echo CHtml::encode($data->magnet_msg_sent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('w3c_order_date')); ?>:</b>
	<?php echo CHtml::encode($data->w3c_order_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_on')); ?>:</b>
	<?php echo CHtml::encode($data->modified_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locked_on')); ?>:</b>
	<?php echo CHtml::encode($data->locked_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locked_by')); ?>:</b>
	<?php echo CHtml::encode($data->locked_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted_on')); ?>:</b>
	<?php echo CHtml::encode($data->deleted_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted_by')); ?>:</b>
	<?php echo CHtml::encode($data->deleted_by); ?>
	<br />

	*/ ?>

</div>
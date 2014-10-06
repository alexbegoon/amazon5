<?php
/* @var $this CouponsController */
/* @var $data Coupons */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coupon_code')); ?>:</b>
	<?php echo CHtml::encode($data->coupon_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percent_or_total')); ?>:</b>
	<?php echo CHtml::encode($data->percent_or_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coupon_type')); ?>:</b>
	<?php echo CHtml::encode($data->coupon_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coupon_value')); ?>:</b>
	<?php echo CHtml::encode($data->coupon_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coupon_start_date')); ?>:</b>
	<?php echo CHtml::encode($data->coupon_start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coupon_expiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->coupon_expiry_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('coupon_value_valid')); ?>:</b>
	<?php echo CHtml::encode($data->coupon_value_valid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode($data->published); ?>
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

	*/ ?>

</div>
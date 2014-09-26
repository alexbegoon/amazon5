<?php
/* @var $this OrderStatusesController */
/* @var $data OrderStatuses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->status_code), array('view', 'id'=>$data->status_code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_name')); ?>:</b>
	<?php echo CHtml::encode($data->status_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_desc')); ?>:</b>
	<?php echo CHtml::encode($data->status_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode($data->published); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('public')); ?>:</b>
	<?php echo CHtml::encode($data->public); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_customer_if_applied')); ?>:</b>
	<?php echo CHtml::encode($data->notify_customer_if_applied); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<?php /*
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
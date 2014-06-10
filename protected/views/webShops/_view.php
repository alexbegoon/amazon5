<?php
/* @var $this WebShopsController */
/* @var $data WebShops */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_name')); ?>:</b>
	<?php echo CHtml::encode($data->shop_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_code')); ?>:</b>
	<?php echo CHtml::encode($data->shop_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('template_name')); ?>:</b>
	<?php echo CHtml::encode($data->template_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_url')); ?>:</b>
	<?php echo CHtml::encode($data->shop_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_language')); ?>:</b>
	<?php echo CHtml::encode($data->default_language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
	<?php echo CHtml::encode($data->currency_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('offline')); ?>:</b>
	<?php echo CHtml::encode($data->offline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_header')); ?>:</b>
	<?php echo CHtml::encode($data->email_header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_footer')); ?>:</b>
	<?php echo CHtml::encode($data->email_footer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_subject')); ?>:</b>
	<?php echo CHtml::encode($data->email_subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_email')); ?>:</b>
	<?php echo CHtml::encode($data->admin_email); ?>
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
<?php
/* @var $this ProvidersController */
/* @var $data Providers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider_name')); ?>:</b>
	<?php echo CHtml::encode($data->provider_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cif')); ?>:</b>
	<?php echo CHtml::encode($data->cif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider_desc')); ?>:</b>
	<?php echo CHtml::encode($data->provider_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider_url')); ?>:</b>
	<?php echo CHtml::encode($data->provider_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider_country')); ?>:</b>
	<?php echo CHtml::encode($data->provider_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider_address')); ?>:</b>
	<?php echo CHtml::encode($data->provider_address); ?>
	<br />

	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('vat')); ?>:</b>
	<?php echo CHtml::encode($data->vat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inactive')); ?>:</b>
	<?php echo CHtml::encode($data->inactive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sku_format')); ?>:</b>
	<?php echo CHtml::encode($data->sku_format); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider_email')); ?>:</b>
	<?php echo CHtml::encode($data->provider_email); ?>
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
<?php
/* @var $this CurrenciesController */
/* @var $data Currencies */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_name')); ?>:</b>
	<?php echo CHtml::encode($data->currency_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_code_2')); ?>:</b>
	<?php echo CHtml::encode($data->currency_code_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_code_3')); ?>:</b>
	<?php echo CHtml::encode($data->currency_code_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_numeric_code')); ?>:</b>
	<?php echo CHtml::encode($data->currency_numeric_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_exchange_rate')); ?>:</b>
	<?php echo CHtml::encode($data->currency_exchange_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_symbol')); ?>:</b>
	<?php echo CHtml::encode($data->currency_symbol); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_decimal_place')); ?>:</b>
	<?php echo CHtml::encode($data->currency_decimal_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_decimal_symbol')); ?>:</b>
	<?php echo CHtml::encode($data->currency_decimal_symbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_thousands')); ?>:</b>
	<?php echo CHtml::encode($data->currency_thousands); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_positive_style')); ?>:</b>
	<?php echo CHtml::encode($data->currency_positive_style); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_negative_style')); ?>:</b>
	<?php echo CHtml::encode($data->currency_negative_style); ?>
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
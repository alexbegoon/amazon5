<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	Yii::t('common','Orders')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Orders')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'order_number',
		'order_pass',
		'order_total',
		'order_subtotal',
		/*
		'order_tax',
		'order_shipment',
		'order_shipment_tax',
		'order_payment',
		'order_payment_tax',
		'order_discount',
		'order_coupon_code',
		'order_coupon_id',
		'order_coupon',
		'currency_id',
		'payment_method_id',
		'shipping_method_id',
		'order_outer_status',
		'order_inner_status',
		'order_tracking_number',
		'customer_note',
		'manager_note',
		'ip_address',
		'web_shop_id',
		'user_profile_data',
		'language_code',
		'magnet_msg_sent',
		'w3c_order_date',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
		'deleted',
		'deleted_on',
		'deleted_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

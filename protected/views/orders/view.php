<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	Yii::t('common','Orders')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Order'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Order'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Orders'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Order')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'order_number',
		'order_pass',
		'order_total',
		'order_subtotal',
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
	),
)); ?>

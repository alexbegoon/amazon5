<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	Yii::t('common','Orders')=>array('index'),
	'#'.$model->id,
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
                array(
                    'name'=>'user_id',
                    'value'=>customer($model->user_id),
                ),
		'order_number',
                array(
                    'name'=>'order_total',
                    'value'=>Currencies::priceDisplay($model->order_total, $model->currency_id),
                ),
                array(
                    'name'=>'order_subtotal',
                    'value'=>Currencies::priceDisplay($model->order_subtotal, $model->currency_id),
                ),
                array(
                    'name'=>'order_tax',
                    'value'=>Currencies::priceDisplay($model->order_tax, $model->currency_id),
                ),
                array(
                    'name'=>'order_shipment',
                    'value'=>Currencies::priceDisplay($model->order_shipment, $model->currency_id),
                ),
                array(
                    'name'=>'order_shipment_tax',
                    'value'=>Currencies::priceDisplay($model->order_shipment_tax, $model->currency_id),
                ),
                array(
                    'name'=>'order_payment',
                    'value'=>Currencies::priceDisplay($model->order_payment, $model->currency_id),
                ),
                array(
                    'name'=>'order_payment_tax',
                    'value'=>Currencies::priceDisplay($model->order_payment_tax, $model->currency_id),
                ),
                array(
                    'name'=>'order_discount',
                    'value'=>Currencies::priceDisplay($model->order_discount, $model->currency_id),
                ),
                'order_coupon_code',
		'order_coupon_id',
                array(
                    'name'=>'order_coupon',
                    'value'=>Currencies::priceDisplay($model->order_coupon, $model->currency_id),
                ),
                array(
                    'name'=>'payment_method_id',
                    'value'=>PaymentMethods::listData($model->payment_method_id),
                ),
                array(
                    'name'=>'shipping_method_id',
                    'value'=>ShippingMethods::listData($model->shipping_method_id),
                ),
                array(
                    'name'=>'order_outer_status',
                    'value'=>OrderStatuses::listData($model->order_outer_status),
                ),
                array(
                    'name'=>'order_inner_status',
                    'value'=>OrderStatuses::listData($model->order_inner_status),
                ),
		'order_tracking_number',
		'customer_note',
		'manager_note',
		'ip_address',
                array(
                    'name'=>'web_shop_id',
                    'value'=>WebShops::getNameByPk($model->web_shop_id),
                ),
                array(
                    'name'=>'user_profile_data',
                    'type'=>'html',
                    'value'=>customerProfile($model->user_profile_data),
                ),
                array(
                    'name'=>'language_code',
                    'value'=>Languages::listData($model->language_code),
                ),
                array(
                    'name'=>'order_paid',
                    'value'=>boolean($model,'order_paid'),
                ),
                array(
                    'name'=>'magnet_msg_sent',
                    'value'=>boolean($model,'magnet_msg_sent'),
                ),
		'w3c_order_date',
		'created_on',
                array(
                    'name'=>'created_by',
                    'value'=>created_by($model),
                ),
		'modified_on',
                array(
                    'name'=>'modified_by',
                    'value'=>modified_by($model),
                ),
                array(
                    'name'=>'deleted',
                    'value'=>boolean($model,'deleted'),
                ),
		'deleted_on',
                array(
                    'name'=>'deleted_by',
                    'value'=>deleted_by($model),
                ),
	),
)); ?>

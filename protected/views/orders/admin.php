<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	Yii::t('common','Orders')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Orders'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Orders')?></h1>

<p>
    <?php echo Yii::t('common','You may optionally enter a comparison operator');?>    (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) 
    <?php echo Yii::t('common','at the beginning of each of your search values to specify how the comparison should be done.');?>    
</p>

<?php echo CHtml::link(Yii::t('common','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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

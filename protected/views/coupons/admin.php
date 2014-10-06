<?php
/* @var $this CouponsController */
/* @var $model Coupons */

$this->breadcrumbs=array(
	Yii::t('common','Coupons')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Coupons'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Coupon'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Coupons')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'coupons-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'coupon_code',
                array(
                    'name'=>'percent_or_total',
                    'value'=>'$data->percent_or_total',
                    'filter'=>enumItem($model, 'percent_or_total'),
                ),
                array(
                    'name'=>'coupon_type',
                    'value'=>'$data->coupon_type',
                    'filter'=>enumItem($model, 'coupon_type'),
                ),
		array(
                    'name'=>'coupon_value',
                    'value'=>'$data->percent_or_total=="total"?
                             Currencies::priceDisplay($data->coupon_value, $data->currency_id):
                             number_format($data->coupon_value,2,".","")." %"',
                ),
                array(
                    'name'=>'coupon_value_valid',
                    'value'=>'Currencies::priceDisplay($data->coupon_value_valid, $data->currency_id)',
                ),
		'coupon_start_date',
		'coupon_expiry_date',
                array(
                    'name'=>'published',
                    'value'=>'Coupons::itemAlias("Published",$data->published)',
                    'filter'=>Coupons::itemAlias("Published"),
                ),
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

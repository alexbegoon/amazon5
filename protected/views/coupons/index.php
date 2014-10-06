<?php
/* @var $this CouponsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Coupons'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Coupon'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Coupons'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Coupons')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
		'coupon_code',
                array(
                    'name'=>'percent_or_total',
                    'value'=>'$data->percent_or_total',
                ),
                array(
                    'name'=>'coupon_type',
                    'value'=>'$data->coupon_type',
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
                ),
		'created_on',
		'modified_on',
            ),
)); ?>

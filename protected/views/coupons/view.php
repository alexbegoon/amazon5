<?php
/* @var $this CouponsController */
/* @var $model Coupons */

$this->breadcrumbs=array(
	Yii::t('common','Coupons')=>array('index'),
	'#'.$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Coupons'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Coupon'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Coupon'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Coupon'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Coupons'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Coupon')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'coupon_code',
		'percent_or_total',
		'coupon_type',
                array(
                    'name'=>'published',
                    'type'=>'raw',
                    'value'=>toggle($model),
                ),
                array(
                    'name'=>'coupon_value',
                    'value'=>$model->percent_or_total=='total'?
                             Currencies::priceDisplay($model->coupon_value, $model->currency_id):
                             number_format($model->coupon_value,2,'.','').' %',
                ),
                array(
                    'name'=>'coupon_value_valid',
                    'value'=>Currencies::priceDisplay($model->coupon_value_valid, $model->currency_id)
                ),
                'coupon_start_date',
		'coupon_expiry_date',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> created_by($model),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> modified_by($model),
                ),
	),
)); ?>

<?php
/* @var $this ShippingCostsController */
/* @var $model ShippingCosts */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Costs')=>array('index'),
	ShippingMethods::listData($model->shipping_method_id),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Costs'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Cost'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Shipping Cost'), 'url'=>array('update', $model->getPrimaryKey())),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Shipping Cost'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete',$model->getPrimaryKey()),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Costs'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> #<?php echo ShippingMethods::listData($model->shipping_method_id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(                
                array(
                    'name'=>'web_shop_id',
                    'value'=>WebShops::listData($model->web_shop_id),
                ),
                array(
                    'name'=>'shipping_method_id',
                    'value'=>ShippingMethods::listData($model->shipping_method_id),
                ),
                array(
                    'name'=>'country_code',
                    'value'=>Countries::listData($model->country_code),
                ),
                array(
                    'name'=>'postal_codes_range_id',
                    'value'=>PostalCodesRanges::listData($model->postal_codes_range_id),
                ),
                array(
                    'name'=>'shipping_company_price',
                    'value'=>Currencies::priceDisplay($model->shipping_company_price, $model->currency_id),
                ),
                array(
                    'name'=>'seller_price',
                    'value'=>Currencies::priceDisplay($model->seller_price, $model->currency_id),
                ),
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

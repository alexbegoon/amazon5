<?php
/* @var $this ShippingCostsController */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Costs'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Cost'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Costs'), 'url'=>array('admin')),
);
?>
<h1 class="text-center"><?php echo Yii::t('common','Shipping Costs')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            array(
                'name'=>'web_shop_id',
                'value'=>'WebShops::listData($data->web_shop_id)',
            ),
            array(
                'name'=>'shipping_method_id',
                'value'=>'ShippingMethods::listData($data->shipping_method_id)',
            ),
            array(
                'name'=>'country_code',
                'value'=>'Countries::listData($data->country_code)',
            ),
            array(
                'name'=>'postal_codes_range_id',
                'value'=>'PostalCodesRanges::listData($data->postal_codes_range_id)',
            ),
            array(
                'name'=>'shipping_company_price',
                'value'=>'Currencies::priceDisplay($data->shipping_company_price, $data->currency_id)',
            ),
            array(
                'name'=>'seller_price',
                'value'=>'Currencies::priceDisplay($data->seller_price, $data->currency_id)',
            ),
            array(
                'name'=>'created_by',
                'value'=>'created_by($data)',
            ),
            'created_on',
            array(
                'name'=>'modified_by',
                'value'=>'modified_by($data)',
            ),
            'modified_on',
        ),
)); ?>
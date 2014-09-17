<?php
/* @var $this ShippingCostsController */
/* @var $model ShippingCosts */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Costs')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Costs'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Cost'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Shipping Costs')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shipping-companies-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'name'=>'web_shop_id',
                    'value'=>'WebShops::listData($data->web_shop_id)',
                    'filter'=>WebShops::listData(),
                ),
                array(
                    'name'=>'shipping_method_id',
                    'value'=>'ShippingMethods::listData($data->shipping_method_id)',
                    'filter'=>ShippingMethods::listData(),
                ),
                array(
                    'name'=>'country_code',
                    'value'=>'Countries::listData($data->country_code)',
                    'filter'=>Countries::listData(),
                ),
                array(
                    'name'=>'postal_codes_range_id',
                    'value'=>'PostalCodesRanges::listData($data->postal_codes_range_id)',
                    'filter'=>PostalCodesRanges::listData(),
                ),
                array(
                    'name'=>'shipping_company_price',
                    'value'=>'Currencies::priceDisplay($data->shipping_company_price, $data->currency_id)',
                ),
                array(
                    'name'=>'seller_price',
                    'value'=>'Currencies::priceDisplay($data->seller_price, $data->currency_id)',
                ),
                'created_on',
                'modified_on',
                array(
                    'class'=>'CButtonColumn',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/view",$data->getPrimaryKey())',
                        ),
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/update",$data->getPrimaryKey())',
                        ),
                        'delete' => array
                        (
                            'click'=>"function(){
                                $.fn.yiiGridView.update('shipping-companies-grid', {  //change my-grid to your grid's name
                                    type:'POST',
                                    url:$(this).attr('href'),
                                    data:{ '".Yii::app()->request->csrfTokenName."':'".Yii::app()->request->csrfToken."' },
                                    success:function(data) {
                                          $.fn.yiiGridView.update('shipping-companies-grid'); //change my-grid to your grid's name
                                    }
                                })
                                return false;
                             }",
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/delete",$data->getPrimaryKey())',
                        ),
                    ),
                ),
	),
)); ?>

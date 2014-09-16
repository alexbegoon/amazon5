<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethods */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Methods')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Method'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Shipping Methods')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shipping-methods-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name'=>'shipping_company_id',
                    'value'=>'ShippingCompanies::listData($data->shipping_company_id)',
                    'filter'=>  ShippingCompanies::listData(),
                ),
		array(
                    'name'=>'shipping_type_id',
                    'value'=>'ShippingTypes::listData($data->shipping_type_id)',
                    'filter'=>ShippingTypes::listData(),
                ),
		array(
                    'name'=>'published',
                    'value'=>'ShippingMethods::itemAlias("Published",$data->published)',
                    'filter'=>ShippingMethods::itemAlias("Published"),
		),
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

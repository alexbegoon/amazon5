<?php
/* @var $this ShippingTypesController */
/* @var $model ShippingTypes */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Types')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Type'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Types'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Shipping Types')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shipping-types-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'shipping_type_name',
		'shipping_type_desc',
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

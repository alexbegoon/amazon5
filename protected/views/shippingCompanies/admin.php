<?php
/* @var $this ShippingCompaniesController */
/* @var $model ShippingCompanies */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Companies')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Companies'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Company'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Shipping Companies')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shipping-companies-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'company_name',
		'company_desc',
		'company_website',
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

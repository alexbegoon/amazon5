<?php
/* @var $this ProvidersController */
/* @var $model Providers */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Providers'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Providers')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'providers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'provider_name',
		'cif',
		'provider_desc',
		'provider_url',
		/*
		'provider_address',
		'vat',
		'inactive',
		'sku_format',
		'provider_email',
		'service_url',
		'sync_params',
		'sync_enabled',
		'sync_schedule',
		'last_sync_date',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

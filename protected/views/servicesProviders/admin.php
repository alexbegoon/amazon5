<?php
/* @var $this ServicesProvidersController */
/* @var $model ServicesProviders */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers of the Services')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers of the Services'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider of the Services'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Providers of the Services')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'services-providers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'provider_name',
		'cif',
                array(
                    'name'=>'provider_type',
                    'value'=>'ServicesProvidersTypes::listData($data->provider_type)',
                    'filter'=>ServicesProvidersTypes::listData(),
                ),
                array(
                    'name'=>'vat_type',
                    'value'=>'$data->vat_type',
                    'filter'=>  enumItem($model, 'vat_type'),
                ),
		'provider_description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

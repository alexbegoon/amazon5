<?php
/* @var $this ProvidersController */
/* @var $model Providers */

$this->breadcrumbs=array(
	Yii::t('common','Providers')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Providers'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Providers'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Providers'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('common','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Provider')?> <?php echo $model->provider_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'provider_name',
		'cif',
		'provider_desc',
		'provider_url',
		'provider_country',
		'provider_address',
		'provider_type',
		'vat',
                array(
                    'name'=>'inactive',
                    'value'=>$model->inactive==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
		'sku_format',
		'provider_email',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

<?php
/* @var $this ServicesProvidersController */
/* @var $model ServicesProviders */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers of the Services')=>array('index'),
	$model->provider_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers of the Services'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider of the Services'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Provider of the Services'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Provider of the Services'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers of the Services'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> #<?php echo $model->provider_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'provider_name',
		'cif',
		array(
                    'name'=>'provider_type',
                    'value'=>  ServicesProvidersTypes::listData($model->provider_type),
                ),
		'provider_description',
		'provider_url',
		array(
                    'name'=>'provider_country',
                    'value'=>Countries::listData($model->provider_country),
                ),
		'provider_address',
		array(
                    'name'=>'default_language',
                    'value'=> Languages::listData($model->default_language),
                ),
		'phone',
                array(
                    'name'=>'vat_type',
                    'value'=>Yii::t('common', $model->vat_type),
                ),
		'vat',
		'provider_email',
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

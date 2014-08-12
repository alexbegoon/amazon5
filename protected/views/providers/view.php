<?php
/* @var $this ProvidersController */
/* @var $model Providers */

$this->breadcrumbs=array(
    Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers')=>array('index'),
	$model->provider_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Providers'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Providers'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Providers'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
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
                'provider_phone',
                'provider_fax',
                array(
                    'name'=>'sku_as_ean',
                    'value'=>$model->sku_as_ean==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
                'discount',
		'provider_type',
		'vat',
                array(
                    'name'=>'inactive',
                    'value'=>$model->inactive==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
                array(
                    'name'=>'currency_id',
                    'value'=> Currencies::listData($model->currency_id),
                ),
                array(
                    'name'=>'default_language',
                    'value'=> Languages::listData($model->default_language),
                ),
		'sku_format',
		'provider_email',
                'service_url',
                array(
                    'name'=>'sync_enabled',
                    'value'=>$model->sync_enabled==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
                'sync_schedule',
                'last_sync_date',
                array(
                    'name'=>'send_csv',
                    'value'=>$model->send_csv==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
                array(
                    'name'=>'send_xls',
                    'value'=>$model->send_xls==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
                'csv_format',
                'xls_format',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
//		'locked_on',
//		'locked_by',
	),
)); ?>

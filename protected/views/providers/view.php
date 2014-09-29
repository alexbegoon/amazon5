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
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Provider'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Provider'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Provider')?> "<?php echo $model->provider_name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'provider_name',
		'cif',
		'provider_desc',
		'provider_url',		
                array(
                    'name'=>'provider_country',
                    'value'=>Countries::listData($model->provider_country),
                ),
		'provider_address',
                'provider_phone',
                'provider_fax',
                array(
                    'name'=>'sku_as_ean',
                    'type'=>'raw',
                    'value'=>toggle($model,'sku_as_ean',array("No","Yes")),
                ),
                'sku_format',
                'discount',
                array(
                    'name'=>'vat_type',
                    'value'=>Yii::t('common', $model->vat_type),
                ),
		'vat',
                array(
                    'name'=>'inactive',
                    'type'=>'raw',
                    'value'=>toggle($model,'inactive',array("Activate","Deactivate")),
                ),
                array(
                    'name'=>'currency_id',
                    'value'=> Currencies::listData($model->currency_id),
                ),
                array(
                    'name'=>'default_language',
                    'value'=> Languages::listData($model->default_language),
                ),
		'provider_email',
		'provider_email_copy_1',
		'provider_email_copy_2',
		'provider_email_hidden_copy',
		'provider_email_hidden_copy_2',
		'email_subject',
		'email_body',
                array(
                    'name'=>'sync_enabled',
                    'type'=>'raw',
                    'value'=>toggle($model,'sync_enabled',array("No","Yes")),
                ),
                'service_url',
                'sync_schedule',
                'last_sync_date',
                array(
                    'name'=>'send_csv',
                    'type'=>'raw',
                    'value'=>toggle($model,'send_csv',array("No","Yes")),
                ),
                'csv_format',
                array(
                    'name'=>'send_xls',
                    'type'=>'raw',
                    'value'=>toggle($model,'send_xls',array("No","Yes")),
                ),
                'xls_format',
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
//		'locked_on',
//		'locked_by',
	),
)); ?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Provider Synchronization Logs')?></h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$providerSyncLogs->search(),
	'filter'=>$providerSyncLogs,
	'columns'=>array(
		'id',
                array(
                    'name'=>'code',
                    'value'=>'ProviderSyncLogs::itemAlias("Code",$data->code)',
                    'filter'=>ProviderSyncLogs::itemAlias("Code"),
                ),
                'provider_product_sku',
                'message',
		'created_on',
		/*
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
		*/
	),
)); ?>

<?php
/* @var $this ProviderInvoicesController */
/* @var $model ProviderInvoices */

$this->breadcrumbs=array(
	Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Provider Invoices')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider Invoice'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Export all data to Excel'), 'url'=>array('admin','excel'=>'export','disablePaging'=>'true')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Provider Invoices')?></h1>


<?php $this->widget('EExcelView', array(
	'id'=>'provider-invoices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        // Excel settings
        'title'=>Yii::t('common','Provider Invoices'),
        'autoWidth'=>true,
        'stream'=>true,
        'template'=>"{exportbuttons}\n{summary}\n{items}\n{pager}\n{exportbuttons}",
        // End Excel settings
	'columns'=>array(
		'id',
		'invoice_number',
                array(
                    'name'=>'provider_id',
                    'value'=>'Providers::listData($data->provider_id)',
                    'filter'=>Providers::listData(),
                ),
                array(
                    'name'=>'vat_type',
                    'header'=>Yii::t('common', 'VAT Type'),
                    'value'=>'$data->provider->vat_type',
                    'filter'=>  enumItem(Providers::model(), 'vat_type'),
                ),
                array(
                    'name'=>'paid',
                    'value'=>'ProviderInvoices::itemAlias("Paid",$data->paid)',
                    'filter'=>ProviderInvoices::itemAlias("Paid"),
                ),
                'paid_date',
                'invoice_date',
                'due_date',
                array(
                    'name'=>'net_cost',
                    'value'=>'Currencies::priceDisplay($data->net_cost,$data->currency_id)',
                    'footer'=>
                    Yii::t('common', 'SubTotal').': '.  Currencies::priceDisplay($model->subtotal_net_cost, $model->total_cost_currency)."\n<br>".
                    Yii::t('common', 'Total').': '.  Currencies::priceDisplay($model->total_net_cost, $model->total_cost_currency),
                ),
                array(
                    'header'=>  Yii::t('common', 'Total Cost'),
                    'name'=>'total_cost',
                    'value'=>'Currencies::priceDisplay($data->net_cost,$data->currency_id,null,$data->provider->vat)',
                    'footer'=>
                    Yii::t('common', 'SubTotal').': '.  Currencies::priceDisplay($model->subtotal, $model->total_cost_currency)."\n<br>".
                    Yii::t('common', 'Total').': '.  Currencies::priceDisplay($model->total, $model->total_cost_currency),
                ),
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 

?>

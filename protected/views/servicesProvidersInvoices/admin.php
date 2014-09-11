<?php
/* @var $this ServicesProvidersInvoicesController */
/* @var $model ServicesProvidersInvoices */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Invoices of the Service Providers')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Invoices of the Service Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Invoice for the Service Providers'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Invoices of the Service Providers')?></h1>


<?php 
//CVarDumper::dump($model->search()->getData(),10,true);die;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'services-providers-invoices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'invoice_number',
                array(
                    'name'=>'provider_id',
                    'value'=>'ServicesProviders::listData($data->provider_id)',
                    'filter'=>ServicesProviders::listData(),
                ),
                array(
                    'name'=>'provider_type',
                    'value'=>'ServicesProvidersTypes::listData($data->provider->provider_type)',
                    'filter'=>ServicesProvidersTypes::listData(),
                ),
                array(
                    'name'=>'vat_type',
                    'header'=>Yii::t('common', 'VAT Type'),
                    'value'=>'$data->provider->vat_type',
                    'filter'=>  enumItem(ServicesProviders::model(), 'vat_type'),
                ),
                array(
                    'name'=>'paid',
                    'value'=>'ServicesProvidersInvoices::itemAlias("Paid",$data->paid)',
                    'filter'=>ServicesProvidersInvoices::itemAlias("Paid"),
                ),
                array(
                    'name'=>'net_cost',
                    'footer'=>
                    Yii::t('common', 'SubTotal').': '.  Currencies::priceDisplay($model->subtotal_cost, $model->total_cost_currency)."\n<br>".
                    Yii::t('common', 'Total').': '.  Currencies::priceDisplay($model->total_cost, $model->total_cost_currency),
                ),
                array(
                    'name'=>'currency_id',
                    'value'=>'Currencies::listData($data->currency_id)',
                    'filter'=>Currencies::listData(),
                ),
		'invoice_date',
		'due_date',
		//'file',
		'created_on',
		'modified_on',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

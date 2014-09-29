<?php
/* @var $this ServicesProvidersInvoicesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Invoices of the Service Providers'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Invoice for the Service Providers'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Invoices of the Service Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Invoices of the Service Providers')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'invoice_number',
            array(
                'name'=>  Yii::t('common', 'Net Cost'),
                'value'=> 'Currencies::priceDisplay($data->net_cost, $data->currency_id)',
            ),
            array(
                'name'=>  Yii::t('common', 'Total Cost'),
                'value'=> 'Currencies::priceDisplay($data->net_cost, $data->currency_id, null, $data->provider->vat)',
            ),
            array(
                'name'=>'provider_id',
                'value'=>'ServicesProviders::listData($data->provider_id)',
            ),
            'invoice_date',
            'due_date',
            array(
                'name'=>'created_by',
                'value'=>'created_by($data)',
            ),
            'created_on',
            array(
                'name'=>'modified_by',
                'value'=>'modified_by($data)',
            ),
            'modified_on',
        ),
)); ?>

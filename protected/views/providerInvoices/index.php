<?php
/* @var $this ProviderInvoicesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Provider Invoices'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Provider Invoices')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'invoice_number',
            array(
                'name'=>  Yii::t('common', 'Provider'),
                'value'=> 'Providers::model()->findByPk($data->provider_id)->provider_name',
            ),
            array(
                'name'=>  Yii::t('common', 'Net Cost'),
                'value'=> 'Currencies::priceDisplay($data->net_cost,$data->currency_id)',
            ),
            array(
                'name'=>  Yii::t('common', 'Total Cost'),
                'value'=> 'Currencies::priceDisplay($data->net_cost,$data->currency_id,null,$data->provider->vat)',
            ),
            array(
                'name'=>  Yii::t('common', 'Paid'),
                'value'=> 'boolean($data,"paid")',
            ),
            'paid_date',
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

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
                'value'=> 'Currencies::priceDisplay($data->totalCost,$data->currency_id)',
            ),
            array(
                'name'=>  Yii::t('common', 'Paid'),
                'value'=> '$data->paid==1?Yii::t("yii","Yes"):Yii::t("yii","No")',
            ),
        ),
)); ?>
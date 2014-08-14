<?php
/* @var $this ProviderInvoicesController */
/* @var $model ProviderInvoices */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Provider Invoices')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Provider Invoices'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Provider Invoices'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Provider Invoices')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
            array(
                'name'=>  Yii::t('common', 'Provider'),
                'value'=> Providers::model()->findByPk($model->provider_id)->provider_name,
            ),
            array(
                'name'=>  Yii::t('common', 'Net Cost'),
                'value'=> Currencies::priceDisplay($model->net_cost, $model->currency_id),
            ),
            array(
                'name'=>  Yii::t('common', 'Total Cost'),
                'value'=> Currencies::priceDisplay($model->totalCost, $model->currency_id),
            ),
            array(
                'name'=>  Yii::t('common', 'paid'),
                'value'=> $model->paid==1?Yii::t("yii","Yes"):Yii::t("yii","No"),
            ),
	),
)); ?>

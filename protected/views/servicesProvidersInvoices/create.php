<?php
/* @var $this ServicesProvidersInvoicesController */
/* @var $model ServicesProvidersInvoices */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Invoices of the Service Providers')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Invoices of the Service Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Invoices of the Service Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Invoice for the Service Providers');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
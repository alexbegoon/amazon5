<?php
/* @var $this ServicesProvidersInvoicesController */
/* @var $model ServicesProvidersInvoices */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Invoices of the Service Providers')=>array('index'),
	'#'.$model->id=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Invoices of the Service Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Invoice for the Service Providers'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Invoice for the Service Providers'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Invoices of the Service Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Invoice');?> #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
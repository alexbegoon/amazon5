<?php
/* @var $this ServicesProvidersTypesController */
/* @var $model ServicesProvidersTypes */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Types of the service providers')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Type of the service provider');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
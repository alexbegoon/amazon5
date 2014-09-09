<?php
/* @var $this ServicesProvidersTypesController */
/* @var $model ServicesProvidersTypes */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Types of the service providers')=>array('index'),
	$model->type=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Type of the service provider'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> #<?php echo $model->type; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
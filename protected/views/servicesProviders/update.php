<?php
/* @var $this ServicesProvidersController */
/* @var $model ServicesProviders */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers of the Services')=>array('index'),
	$model->provider_name=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers of the Services'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider of the Services'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Provider of the Services'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers of the Services'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> #<?php echo $model->provider_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
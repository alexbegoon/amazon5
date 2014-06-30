<?php
/* @var $this ProvidersController */
/* @var $model Providers */

$this->breadcrumbs=array(
	Yii::t('common','Provider')=>array('index'),
	$model->provider_name=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Provider'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Provider');?> <?php echo $model->provider_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
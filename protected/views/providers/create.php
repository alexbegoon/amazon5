<?php
/* @var $this ProvidersController */
/* @var $model Providers */

$this->breadcrumbs=array(
    Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Provider');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
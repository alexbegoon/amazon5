<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */

$this->breadcrumbs=array(
	Yii::t('common','Order Statuses')=>array('index'),
	$model->status_code=>array('view','id'=>$model->status_code),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Order Statuses'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order Statuses'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Order Statuses'), 'url'=>array('view', 'id'=>$model->status_code)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Order Statuses'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Order Statuses');?> <?php echo $model->status_code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
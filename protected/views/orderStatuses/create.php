<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */

$this->breadcrumbs=array(
	Yii::t('common','Order Statuses')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Order Statuses'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Order Statuses'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Order Status');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,
                                          'orderStatusTranslations'=>$orderStatusTranslations      )); ?>
<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatusTranslations */

$this->breadcrumbs=array(
	Yii::t('common','Order Statuses')=>array('index'),
        OrderStatuses::model()->findByPk($model->status_code)->getName()=>array('view','id'=>$model->status_code),
	Yii::t('common','Create')." ".Yii::t('common','Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Order Statuses'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Order Statuses'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array(  'model'=>$model)); ?>
<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
         OrderStatuses::model()->findByPk($model->status_code)->getName()=>array('view','id'=>$model->status_code),
	Yii::t('common','Update')." ".Yii::t('common', 'Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Order Statuses'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order Status'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Order Status'), 'url'=>array('view', 'id'=>$model->status_code)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Order Statuses'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array('model'=>$model)); ?>
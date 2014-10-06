<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	Yii::t('common','Orders')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Orders'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Orders'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Orders'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Orders');?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
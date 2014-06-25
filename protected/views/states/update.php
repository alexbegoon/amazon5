<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	Yii::t('common','States')=>array('index'),
	$model->state_name=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','States'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','States'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','States'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','States'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'States');?> <?php echo $model->state_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
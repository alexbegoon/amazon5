<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	Yii::t('common','States')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','States'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','States'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'States');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
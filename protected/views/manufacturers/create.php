<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	Yii::t('common','Manufacturers')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Manufacturers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Manufacturers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Manufacturers');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'modelTranslation'=>$modelTranslation)); ?>
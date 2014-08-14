<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	Yii::t('common','Manufacturers')=>array('index'),
	Manufacturers::model()->findByPk($model->manufacturer_id)->getName()=>array('view','id'=>$model->manufacturer_id),
	Yii::t('common','Update')." ".Yii::t('common', 'Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Manufacturers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Manufacturer'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Manufacturer'), 'url'=>array('view', 'id'=>$model->manufacturer_id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Manufacturers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array('model'=>$model)); ?>
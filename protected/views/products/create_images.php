<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
        '#'.Products::getSKUbyPk($model->product_id)=>array('view','id'=>$model->product_id),
	Yii::t('common','Create')." ".Yii::t('common','Image'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Image');?></h1>

<?php $this->renderPartial('_images', array(  'model'=>$model)); ?>
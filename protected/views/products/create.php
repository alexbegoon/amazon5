<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Product');?></h1>

<?php $this->renderPartial('_form', array(  'model'=>$model,
                                            'productTranslation'=>$productTranslation,
                                            'productManufaturers'=>$productManufaturers,
                                            'productPrices'=>$productPrices,
                                            'productImages'=>$productImages,)); ?>
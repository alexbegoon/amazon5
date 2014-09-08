<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
        '#'.Products::getSKUbyPk($model->id)=>array('view','id'=>$model->id),
	Yii::t('common','Assign a product to the category'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Assign a product to the category');?></h1>

<?php $this->renderPartial('_category', array('model'=>$productCategories,
                                              'category'=>$category)); ?>
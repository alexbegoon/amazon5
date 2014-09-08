<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	'#'.Products::getSKUbyPk($model->product_id)=>array('view','id'=>$model->product_id),
	Yii::t('common','Update')." ".Yii::t('common', 'Price'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Products'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Products'), 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Price');?></h1>

<?php $this->renderPartial('_prices', array('model'=>$model)); ?>
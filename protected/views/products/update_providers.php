<?php
/* @var $this ProductsController */
/* @var $model ProviderProducts */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	'#'.Products::getSKUbyPk($model->product_id)=>array('view','id'=>$model->product_id),
	Yii::t('common','Update')." ".Yii::t('common', 'Provider'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Product'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Product'), 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Provider');?></h1>

<?php $this->renderPartial('_providers', array('model'=>$model)); ?>
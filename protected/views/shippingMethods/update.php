<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethods */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Methods')=>array('index'),
	$model->getName()=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Method'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Shipping Method'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Shipping Method');?> '<?php echo $model->getName(); ?>'</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
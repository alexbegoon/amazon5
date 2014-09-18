<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethods */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Methods')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Shipping Methods');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,
                                          'shippingMethodTranslation'=>$shippingMethodTranslation)); ?>
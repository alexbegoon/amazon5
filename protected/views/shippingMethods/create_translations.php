<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethodTranslations */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Methods')=>array('index'),
        ShippingMethods::model()->findByPk($model->shipping_method_id)->getName()=>array('view','id'=>$model->shipping_method_id),
	Yii::t('common','Create')." ".Yii::t('common','Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array(  'model'=>$model)); ?>
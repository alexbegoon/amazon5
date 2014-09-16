<?php
/* @var $this ShippingMethodsController */
/* @var $model ShippingMethodTranslations */

$this->breadcrumbs=array(
	Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Methods')=>array('index'),
        ShippingMethods::model()->findByPk($model->shipping_method_id)->getName()=>array('view','id'=>$model->shipping_method_id),
	Yii::t('common','Update')." ".Yii::t('common','Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Method'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Shipping Method'), 'url'=>array('view', 'id'=>$model->shipping_method_id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array('model'=>$model)); ?>
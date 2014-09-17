<?php
/* @var $this ShippingCostsController */
/* @var $model ShippingCosts */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Costs')=>array('index'),
	ShippingMethods::listData($model->shipping_method_id)=>array('view',$model->getPrimaryKey()),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Costs'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Cost'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Shipping Cost'), 'url'=>array('view', $model->getPrimaryKey())),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Costs'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> #<?php echo ShippingMethods::listData($model->shipping_method_id); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
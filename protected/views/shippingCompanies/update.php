<?php
/* @var $this ShippingCompaniesController */
/* @var $model ShippingCompanies */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Companies')=>array('index'),
	$model->company_name=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Companies'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Company'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Shipping Company'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Companies'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> #<?php echo $model->company_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
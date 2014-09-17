<?php
/* @var $this PostalCodesRangesController */
/* @var $model PostalCodesRanges */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Postal Codes Ranges')=>array('index'),
	$model->range_name=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Ranges of the Postal Codes');?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this PostalCodesRangesController */
/* @var $model PostalCodesRanges */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Postal Codes Ranges')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Ranges of the Postal Codes');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
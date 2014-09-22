<?php
/* @var $this FeesController */
/* @var $model Fees */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Fees')=>array('index'),
	$model->code=>array('view','id'=>$model->code),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Fees'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Fee'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Fee'), 'url'=>array('view', 'id'=>$model->code)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Fees'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Fees');?> <?php echo $model->code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
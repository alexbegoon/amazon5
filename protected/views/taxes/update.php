<?php
/* @var $this TaxesController */
/* @var $model Taxes */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Taxes')=>array('index'),
	Countries::listData($model->country_code)=>array('view','id'=>$model->country_code),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Taxes'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Tax'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Tax'), 'url'=>array('view', 'id'=>$model->country_code)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Taxes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Taxes');?> #<?php echo Countries::listData($model->country_code); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
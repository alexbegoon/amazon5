<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	Yii::t('common','Countries')=>array('index'),
	$model->name=>array('view','id'=>$model->code),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Countries'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Countries'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Countries'), 'url'=>array('view', 'id'=>$model->code)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Countries'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Countries');?> <?php echo $model->code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
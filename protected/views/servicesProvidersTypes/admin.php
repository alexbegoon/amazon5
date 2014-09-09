<?php
/* @var $this ServicesProvidersTypesController */
/* @var $model ServicesProvidersTypes */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Types of the service providers')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Type of the service provider'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Types of the service providers')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'services-providers-types-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'type',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

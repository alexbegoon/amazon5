<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	Yii::t('common','States')=>array('index'),
	$model->state_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','States'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','States'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','States'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','States'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','States'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'States')?> <?php echo $model->state_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country_code',
		'state_name',
		'state_3_code',
		'state_2_code',
		'published',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

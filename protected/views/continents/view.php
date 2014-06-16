<?php
/* @var $this ContinentsController */
/* @var $model Continents */

$this->breadcrumbs=array(
	'Continents'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Continents', 'url'=>array('index')),
	array('label'=>'Create Continents', 'url'=>array('create')),
	array('label'=>'Update Continents', 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>'Delete Continents', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Continents', 'url'=>array('admin')),
);
?>

<h1 class="text-center">View Continents #<?php echo $model->code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
		'published',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

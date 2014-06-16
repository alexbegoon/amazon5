<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'States'=>array('index'),
	$model->state_name,
);

$this->menu=array(
	array('label'=>'List States', 'url'=>array('index')),
	array('label'=>'Create States', 'url'=>array('create')),
	array('label'=>'Update States', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete States', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage States', 'url'=>array('admin')),
);
?>

<h1 class="text-center">View <?php echo $model->state_name; ?></h1>

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

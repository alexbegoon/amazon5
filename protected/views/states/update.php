<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'States'=>array('index'),
	$model->state_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List States', 'url'=>array('index')),
	array('label'=>'Create States', 'url'=>array('create')),
	array('label'=>'View States', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage States', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Update <?php echo $model->state_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
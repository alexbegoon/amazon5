<?php
/* @var $this ContinentsController */
/* @var $model Continents */

$this->breadcrumbs=array(
	'Continents'=>array('index'),
	$model->name=>array('view','id'=>$model->code),
	'Update',
);

$this->menu=array(
	array('label'=>'List Continents', 'url'=>array('index')),
	array('label'=>'Create Continents', 'url'=>array('create')),
	array('label'=>'View Continents', 'url'=>array('view', 'id'=>$model->code)),
	array('label'=>'Manage Continents', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Update Continents <?php echo $model->code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
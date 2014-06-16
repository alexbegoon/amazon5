<?php
/* @var $this ContinentsController */
/* @var $model Continents */

$this->breadcrumbs=array(
	'Continents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Continents', 'url'=>array('index')),
	array('label'=>'Manage Continents', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Create Continents</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
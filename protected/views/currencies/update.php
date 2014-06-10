<?php
/* @var $this CurrenciesController */
/* @var $model Currencies */

$this->breadcrumbs=array(
	'Currencies'=>array('index'),
	$model->currency_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Currencies', 'url'=>array('index')),
	array('label'=>'Create Currencies', 'url'=>array('create')),
	array('label'=>'View Currencies', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Currencies', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Update Currencies <?php echo $model->currency_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
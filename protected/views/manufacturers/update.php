<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	'Manufacturers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Manufacturers', 'url'=>array('index')),
	array('label'=>'Create Manufacturers', 'url'=>array('create')),
	array('label'=>'View Manufacturers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Manufacturers', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Update Manufacturers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'manufacturerTranslations'=>$manufacturerTranslations)); ?>
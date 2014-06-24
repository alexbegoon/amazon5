<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	'Manufacturers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Manufacturers', 'url'=>array('index')),
	array('label'=>'Manage Manufacturers', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Create Manufacturers</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'manufacturerTranslations'=>$manufacturerTranslations)); ?>
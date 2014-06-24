<?php
/* @var $this ManufacturersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Manufacturers',
);

$this->menu=array(
	array('label'=>'Create Manufacturers', 'url'=>array('create')),
	array('label'=>'Manage Manufacturers', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Manufacturers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

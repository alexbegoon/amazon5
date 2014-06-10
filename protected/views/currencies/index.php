<?php
/* @var $this CurrenciesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Currencies',
);

$this->menu=array(
	array('label'=>'Create Currencies', 'url'=>array('create')),
	array('label'=>'Manage Currencies', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Currencies</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
)); ?>

<?php
/* @var $this WebShopsController */
/* @var $model WebShops */

$this->breadcrumbs=array(
	'Web Shops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebShops', 'url'=>array('index')),
	array('label'=>'Manage WebShops', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Create WebShops</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
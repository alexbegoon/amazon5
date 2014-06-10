<?php
/* @var $this WebShopsController */
/* @var $model WebShops */

$this->breadcrumbs=array(
	'Web Shops'=>array('index'),
	$model->shop_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebShops', 'url'=>array('index')),
	array('label'=>'Create WebShops', 'url'=>array('create')),
	array('label'=>'View WebShops', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebShops', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Update WebShops <?php echo $model->shop_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
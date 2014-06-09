<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->title=>array('view','id'=>$model->lang_code),
	'Update',
);

$this->menu=array(
	array('label'=>'List Languages', 'url'=>array('index')),
	array('label'=>'Create Languages', 'url'=>array('create')),
	array('label'=>'View Languages', 'url'=>array('view', 'id'=>$model->lang_code)),
	array('label'=>'Manage Languages', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Update Languages <?php echo $model->lang_code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
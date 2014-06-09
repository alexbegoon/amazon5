<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Languages', 'url'=>array('index')),
	array('label'=>'Create Languages', 'url'=>array('create')),
	array('label'=>'Update Languages', 'url'=>array('update', 'id'=>$model->lang_code)),
	array('label'=>'Delete Languages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lang_code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Languages', 'url'=>array('admin')),
);
?>

<h1>View Languages #<?php echo $model->lang_code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lang_code',
		'title',
		'title_native',
		'sef',
		'image_url',
		'image_url_thumb',
		'published',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

<?php
/* @var $this WebShopsController */
/* @var $model WebShops */

$this->breadcrumbs=array(
	'Web Shops'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebShops', 'url'=>array('index')),
	array('label'=>'Create WebShops', 'url'=>array('create')),
	array('label'=>'Update WebShops', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebShops', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebShops', 'url'=>array('admin')),
);
?>

<h1 class="text-center">View WebShops #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shop_name',
		'shop_code',
		'template_name',
		'shop_url',
		'default_language',
		'currency_id',
		'offline',
		'email',
		'email_header',
		'email_footer',
		'email_subject',
		'admin_email',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

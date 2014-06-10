<?php
/* @var $this CurrenciesController */
/* @var $model Currencies */

$this->breadcrumbs=array(
	'Currencies'=>array('index'),
	$model->currency_name,
);

$this->menu=array(
	array('label'=>'List Currencies', 'url'=>array('index')),
	array('label'=>'Create Currencies', 'url'=>array('create')),
	array('label'=>'Update Currencies', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Currencies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Currencies', 'url'=>array('admin')),
);
?>

<h1 class="text-center">View Currencies #<?php echo $model->currency_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'currency_name',
		'currency_code_2',
		'currency_code_3',
		'currency_numeric_code',
		'currency_exchange_rate',
		'currency_symbol',
		'currency_decimal_place',
		'currency_decimal_symbol',
		'currency_thousands',
		'currency_positive_style',
		'currency_negative_style',
		'published',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

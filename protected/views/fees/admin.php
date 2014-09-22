<?php
/* @var $this FeesController */
/* @var $model Fees */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Fees')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Fees'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Fee'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Fees')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fees-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'code',
		'fee_type',
		'fee_mode',
		'percent',
                array(
                    'name'=>'amount',
                    'value'=>  'Currencies::priceDisplay($data->amount, $data->currency_id)'
                ),
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

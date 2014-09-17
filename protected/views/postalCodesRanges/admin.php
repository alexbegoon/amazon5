<?php
/* @var $this PostalCodesRangesController */
/* @var $model PostalCodesRanges */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Postal Codes Ranges')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Postal Codes Ranges')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'postal-codes-ranges-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'range_name',		
                array(
                    'name'=>'country_code',
                    'value'=>  'Countries::listData($data->country_code)',
                    'filter'=>Countries::listData(),
                ),
		'postal_code_from',
		'postal_code_to',
		'created_on',
                'modified_on',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

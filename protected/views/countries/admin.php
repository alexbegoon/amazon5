<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	Yii::t('common','Countries')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Countries'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Countries'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Countries')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'countries-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'code',
		'name',
		'full_name',
		'iso3',
		'number',
                array(
                    'name'=>'continent_code',
                    'value'=>  'Continents::listData($data->continent_code)',
                    'filter'=>Continents::listData(),
                ),
                array(
                    'name'=>'published',
                    'value'=>'boolean($data)',
                ),
                array(
                    'name'=>'created_by',
                    'value'=>'created_by($data)',
                ),
		'created_on',

                array(
                    'name'=>'modified_by',
                    'value'=>'modified_by($data)',
                ),
		'modified_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	Yii::t('common','States')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','States'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','States'), 'url'=>array('create')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','States')?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'states-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                'state_name',
                array(
                    'name'=>'country_code',
                    'value'=>  'Countries::listData($data->country_code)',
                    'filter'=>  Countries::listData()
                ),
		'state_3_code',
		'state_2_code',
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

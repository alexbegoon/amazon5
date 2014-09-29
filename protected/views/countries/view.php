<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	Yii::t('common','Countries')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Countries'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Countries'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Countries'), 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Countries'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Countries'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Countries')?> <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
		'full_name',
		'iso3',
		'number',
		'continent_code',
		array(
                    'name'=>'published',
                    'type'=>'raw',
                    'value'=>toggle($model),
                ),
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> created_by($model),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> modified_by($model),
                ),
		'locked_on',
		'locked_by',
	),
)); ?>

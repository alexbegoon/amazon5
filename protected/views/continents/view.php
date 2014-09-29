<?php
/* @var $this ContinentsController */
/* @var $model Continents */

$this->breadcrumbs=array(
	Yii::t('common','Continents')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Continents'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Continents'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Continents'), 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Continents'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Continents'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Continents')?> "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
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

<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	Yii::t('common','Manufacturers')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Manufacturers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Manufacturers'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Manufacturers'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Manufacturers'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('common','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Manufacturers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Manufacturers')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'hits',
		'manufacturer_email',
		'manufacturer_url',
                    array(
                    'name'=>'published',
                    'value'=>$model->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No"),
                ),
		'created_on',
                'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>

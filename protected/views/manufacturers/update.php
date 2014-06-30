<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	Yii::t('common','Manufacturers')=>array('index'),
	'#'.$model->id=>array('view','id'=>$model->id),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Manufacturers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Manufacturers'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Manufacturers'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Manufacturers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Manufacturers');?> <?php echo $model->id; ?></h1>

<p><?php echo Yii::t('common', 'Available translations for this item.')?></p>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name'=>Yii::t('common', 'Language'),
            'value'=>'$data->language->title_native'
        ),
        'manufacturer_name',
        'manufacturer_desc',
        'slug',
    ),
));

?>

<?php $this->renderPartial('_form', array('model'=>$model, 'modelTranslation'=>$modelTranslation)); ?>


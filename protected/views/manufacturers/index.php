<?php
/* @var $this ManufacturersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Manufacturers'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Manufacturers'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Manufacturers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manufacturers')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
        'columns'=>array(
        'id',
        array(
            'name'=>  Yii::t('common', 'Manufacturer Name'),
            'value'=>'$data->getName()',
        ),
        'hits',
        'manufacturer_email',
        'manufacturer_url',
        array(
            'name'=>'published',
            'value'=>'$data->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
        ),
        ),
)); ?>

<?php 



?>

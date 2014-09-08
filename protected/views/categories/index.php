<?php
/* @var $this CategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Categories'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Category'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Categories')?></h1>

<?php $this->renderPartial('tree', array()); ?>
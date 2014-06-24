<?php
/* @var $this WebShopsController */
/* @var $model WebShops */

$this->breadcrumbs=array(
	Yii::t('common','Web Shops')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Web Shops'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Web Shops'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Create')?> <?php echo Yii::t('common','Web Shop')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
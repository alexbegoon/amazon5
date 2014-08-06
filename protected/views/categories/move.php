<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
	$model->getName()=>array('view','id'=>$model->id),
	Yii::t('common','Move this category'),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Move this category');?></h1>

<?php $this->renderPartial('_move', array('categoryCategories'=>$categoryCategories,
                                          'model'=>$model)); ?>
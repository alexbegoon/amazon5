<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Categories'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Categories'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Category');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,
                                          'categoryImages'=>$categoryImages,
                                          'categoryTranslations'=>$categoryTranslations,
                                          'categoryCategories'=>$categoryCategories  
    )); ?>
<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
	Categories::model()->findByPk($model->category_id)->getName()=>array('view','id'=>$model->category_id),
	Yii::t('common','Update')." ".Yii::t('common', 'Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Categories'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Category'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Category'), 'url'=>array('view', 'id'=>$model->category_id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Categories'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array('model'=>$model)); ?>
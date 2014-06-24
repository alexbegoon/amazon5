<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	Yii::t('common','Languages')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Languages'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Languages'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Languages');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
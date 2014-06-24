<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	Yii::t('common','Languages')=>array('index'),
	$model->title=>array('view','id'=>$model->lang_code),
	Yii::t('common','Update'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Languages'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Languages'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Languages'), 'url'=>array('view', 'id'=>$model->lang_code)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Languages'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Languages');?> <?php echo $model->lang_code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
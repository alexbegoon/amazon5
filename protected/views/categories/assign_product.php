<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
        $model->getName()=>array('view','id'=>$model->id),
	Yii::t('common','Assign products'),
);

$this->menu=array(
//        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Categories'), 'url'=>array('index')),
//	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Categories'), 'url'=>array('admin')),
);
?>
<h1 class="text-center"><?php echo Yii::t('common', 'Assign products');?> "<?php echo $model->getName()?>"</h1>
<?php $this->renderPartial('_assign_product', array(  'model'=>$model,'productCategories'=>$productCategories)); ?>
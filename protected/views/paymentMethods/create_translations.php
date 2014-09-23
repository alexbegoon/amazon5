<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethodTranslations */

$this->breadcrumbs=array(
        Yii::t('common','Payment')=>array('payment/index'),
	Yii::t('common','Payment Methods')=>array('index'),
        PaymentMethods::model()->findByPk($model->payment_method_id)->getName()=>array('view','id'=>$model->payment_method_id),
	Yii::t('common','Create')." ".Yii::t('common','Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Payment Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Payment Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Translation');?></h1>

<?php $this->renderPartial('_translations', array(  'model'=>$model)); ?>
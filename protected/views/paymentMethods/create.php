<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
        Yii::t('common', 'Payment')=>array('payment/index'),
	Yii::t('common','Payment Methods')=>array('index'),
	Yii::t('common','Create'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Payment Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Payment Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Create');?> <?php echo Yii::t('common', 'Payment Method');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,
                                          'paymentMethodTranslation'=>$paymentMethodTranslation,
                                          'paypalParams'=>$paypalParams,)); ?>
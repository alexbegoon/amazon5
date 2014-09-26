<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
	Yii::t('common','Payment')=>array('payment/index'),
	Yii::t('common','Payment Methods')=>array('index'),
        $model->getName()=>array('view','id'=>$model->id),
	Yii::t('common','Update')." ".Yii::t('common','Translation'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Payment Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Payment Method'), 'url'=>array('create')),
        array('label'=>Yii::t('common','View') .' '. Yii::t('common','Payment Method'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Payment Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Update');?> <?php echo Yii::t('common', 'Parameters');?></h1>

<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-methods-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model,$paramsModel), null, null, array('class'=>'alert alert-danger')); ?>
<?php $this->renderPartial($formName, array('model'=>$model,
                                            'paramsModel'=>$paramsModel,
                                            'form'=>$form,
    )); ?>

<?php $this->endWidget(); ?>
<hr>
	<div class="row form-group buttons">
		<?php echo CHtml::submitButton(Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>
</div>
</div>
</div>
<!-- form -->
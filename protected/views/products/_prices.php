<?php
/* @var $this ProductPricesController */
/* @var $model ProductPrices */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-prices-_prices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

        <?php echo $form->hiddenField($model,'product_id',array('class'=>'form-control')); ?>

        <div class="row form-group">
		<?php echo $form->labelEx($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'web_shop_id',WebShops::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_price',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_price',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_price',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'override',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'override'); ?>
		<?php echo $form->error($model,'override',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'product_override_price',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_override_price',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_override_price',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_tax_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_tax_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_tax_id',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'product_discount_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_discount_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_discount_id',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'price_quantity_start',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'price_quantity_start',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'price_quantity_start',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'price_quantity_end',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'price_quantity_end',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'price_quantity_end',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
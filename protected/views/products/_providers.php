<?php
/* @var $this ProductsController */
/* @var $model ProviderProducts */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-providers-_providers-form',
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
		<?php echo $form->labelEx($model,'provider_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'provider_id',Providers::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_id',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_product_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_product_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_product_name',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_price',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_price',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_price',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'quantity_in_stock',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'quantity_in_stock',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'quantity_in_stock',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_brand',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_brand',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_brand',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_category',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_category',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_category',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_sex',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_sex',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_sex',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_image_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_image_url',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_image_url',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'provider_thumb_image_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'provider_thumb_image_url',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provider_thumb_image_url',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'inner_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'inner_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'inner_id',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'inner_sku',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'inner_sku',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'inner_sku',array('class'=>'label label-danger')); ?>
	</div>       
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'blocked',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'blocked'); ?>
		<?php echo $form->error($model,'blocked',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-4 col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model,$productTranslation,$productManufaturers,$productPrices,$productImages), null, null, array('class'=>'alert alert-danger')); ?>

        <div class="row form-group">
		<?php echo $form->labelEx($model,'product_sku',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_sku',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_sku',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($productTranslation,'language_code',  Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'language_code',array('class'=>'label label-danger')); ?>
	</div>
    
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'product_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productTranslation,'product_name',array('size'=>32,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'product_name',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'product_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($productTranslation,'product_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'product_desc',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'product_s_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($productTranslation,'product_s_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'product_s_desc',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'meta_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productTranslation,'meta_desc',array('size'=>32,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'meta_desc',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'meta_keywords',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productTranslation,'meta_keywords',array('size'=>32,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'meta_keywords',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'custom_title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productTranslation,'custom_title',array('size'=>32,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'custom_title',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productTranslation,'slug',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productTranslation,'slug',array('size'=>32,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($productTranslation,'slug',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($productManufaturers,'manufacturer_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($productManufaturers,'manufacturer_id',  Manufacturers::listData(), array('class'=>'form-control')); ?>
		<?php echo $form->error($productManufaturers,'manufacturer_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($productPrices,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($productPrices,'web_shop_id', WebShops::listData(), array('class'=>'form-control')); ?>
		<?php echo $form->error($productPrices,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productPrices,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($productPrices,'currency_id', Currencies::listData(), array('class'=>'form-control')); ?>
		<?php echo $form->error($productPrices,'currency_id',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productPrices,'product_price',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productPrices,'product_price',array('class'=>'form-control')); ?>
		<?php echo $form->error($productPrices,'product_price',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($productImages,'image',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeFileField($productImages, 'image'); ?>
		<?php echo $form->error($productImages,'image',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productImages,'thumb_width',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productImages,'thumb_width',array('class'=>'form-control')); ?>
		<?php echo $form->error($productImages,'thumb_width',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productImages,'thumb_height',array('class'=>'control-label')); ?>
		<?php echo $form->textField($productImages,'thumb_height',array('class'=>'form-control')); ?>
		<?php echo $form->error($productImages,'thumb_height',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($productImages,'thumb_quality',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($productImages,'thumb_quality', ProductImages::listQualities(),array('class'=>'form-control')); ?>
		<?php echo $form->error($productImages,'thumb_quality',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'product_parent_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'product_parent_id',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'product_parent_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>    
	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>

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
</div>
<!-- form -->
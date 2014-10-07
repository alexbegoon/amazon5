<?php
/* @var $this ShippingCostsController */
/* @var $model ShippingCosts */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shipping-costs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <?php
    Yii::app()->clientScript->registerScript('search', "
        $(function(){
            
            var initRanges = function(){
                $('#ShippingCosts_postal_codes_range_id optgroup').attr('disabled',true);
                $('#ShippingCosts_postal_codes_range_id optgroup[label=\"'+$('#ShippingCosts_country_code').find(':selected').text()+'\"]').attr('disabled',false);
            };

            initRanges();
            $('#ShippingCosts_country_code').change(function(){
                initRanges();
            });
        });
        ");
    ?>
    
    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'web_shop_id', WebShops::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'shipping_method_id',  ShippingMethods::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_method_id',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'country_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'country_code', Countries::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'country_code',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'postal_codes_range_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'postal_codes_range_id', PostalCodesRanges::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'postal_codes_range_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id', Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_company_price',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shipping_company_price',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_company_price',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'seller_price',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'seller_price',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'seller_price',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
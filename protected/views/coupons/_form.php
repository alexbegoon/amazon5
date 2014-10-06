<?php
/* @var $this CouponsController */
/* @var $model Coupons */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coupons-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'coupon_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'coupon_code',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'coupon_code',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'percent_or_total',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'percent_or_total',enumItem($model, 'percent_or_total'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'percent_or_total',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'coupon_type',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'coupon_type',enumItem($model,'coupon_type'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'coupon_type',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'coupon_value',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'coupon_value',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'coupon_value',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'coupon_value_valid',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'coupon_value_valid',array('size'=>15,'maxlength'=>15,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'coupon_value_valid',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'coupon_start_date',array('class'=>'control-label')); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Coupons[coupon_start_date]',
                    'value'=>$model->coupon_start_date,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'dateFormat'=>'yy-mm-dd',
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                    ),
                    'language'=>  Yii::app()->language,
                ));
                ?>
		<?php echo $form->error($model,'coupon_start_date',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'coupon_expiry_date',array('class'=>'control-label')); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Coupons[coupon_expiry_date]',
                    'value'=>$model->coupon_expiry_date,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'dateFormat'=>'yy-mm-dd',
                        'minDate'=>1,
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                    ),
                    'language'=>  Yii::app()->language,
                ));
                ?>
		<?php echo $form->error($model,'coupon_expiry_date',array('class'=>'label label-danger')); ?>
	</div>

	

	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
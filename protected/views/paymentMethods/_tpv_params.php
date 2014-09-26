<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */
/* @var $form CActiveForm */
?>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'tpv_email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paramsModel,'tpv_email',array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'tpv_email',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'tpv_commerce_key',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paramsModel,'tpv_commerce_key',array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'tpv_commerce_key',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'tpv_password',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($paramsModel,'tpv_password',array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'tpv_password',array('class'=>'label label-danger')); ?>
</div>
<hr>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'sandbox_mode',array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($paramsModel,'sandbox_mode'); ?>
        <?php echo $form->error($paramsModel,'sandbox_mode',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'debug',array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($paramsModel,'debug'); ?>
        <?php echo $form->error($paramsModel,'debug',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'payment_currency',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paramsModel,'payment_currency',Currencies::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'payment_currency',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'countries',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paramsModel,'countries',Countries::listData(),array('multiple'=>'multiple','size'=>10 ,'class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'countries',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'min_amount',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paramsModel,'min_amount',array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'min_amount',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'max_amount',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paramsModel,'max_amount',array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'max_amount',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'fee_code',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paramsModel,'fee_code',Fees::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'fee_code',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'tax',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paramsModel,'tax',array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'tax',array('class'=>'label label-danger')); ?>
</div>
<hr>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'status_pending',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paramsModel,'status_pending',OrderStatuses::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'status_pending',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'status_success',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paramsModel,'status_success',OrderStatuses::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'status_success',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paramsModel,'status_canceled',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paramsModel,'status_canceled',OrderStatuses::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paramsModel,'status_canceled',array('class'=>'label label-danger')); ?>
</div>
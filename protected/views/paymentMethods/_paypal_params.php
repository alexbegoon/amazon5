<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'paypal_email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paypalParams,'paypal_email',array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'paypal_email',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'only_verified_buyers',array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($paypalParams,'only_verified_buyers'); ?>
        <?php echo $form->error($paypalParams,'only_verified_buyers',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'paypal_sandbox_email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paypalParams,'paypal_sandbox_email',array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'paypal_sandbox_email',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'sandbox_mode',array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($paypalParams,'sandbox_mode'); ?>
        <?php echo $form->error($paypalParams,'sandbox_mode',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'debug',array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($paypalParams,'debug'); ?>
        <?php echo $form->error($paypalParams,'debug',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'address_override',array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($paypalParams,'address_override'); ?>
        <?php echo $form->error($paypalParams,'address_override',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'no_shipping',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'no_shipping',  PayPalParams::itemAlias('no_shipping'),array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'no_shipping',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'payment_currency',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'payment_currency',Currencies::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'payment_currency',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'countries',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'countries',Countries::listData(),array('multiple'=>'multiple','size'=>10 ,'class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'countries',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'min_amount',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paypalParams,'min_amount',array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'min_amount',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'max_amount',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paypalParams,'max_amount',array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'max_amount',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'fee_code',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'fee_code',Fees::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'fee_code',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'tax',array('class'=>'control-label')); ?>
        <?php echo $form->textField($paypalParams,'tax',array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'tax',array('class'=>'label label-danger')); ?>
</div>
<hr>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'status_pending',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'status_pending',OrderStatuses::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'status_pending',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'status_success',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'status_success',OrderStatuses::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'status_success',array('class'=>'label label-danger')); ?>
</div>
<div class="row form-group">
        <?php echo $form->labelEx($paypalParams,'status_canceled',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($paypalParams,'status_canceled',OrderStatuses::listData(),array('class'=>'form-control')); ?>
        <?php echo $form->error($paypalParams,'status_canceled',array('class'=>'label label-danger')); ?>
</div>
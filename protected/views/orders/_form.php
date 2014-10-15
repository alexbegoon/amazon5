<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); 

Yii::app()->clientScript->registerScript('updateFields', "
function updateFields(data){
    if(!data)
        return;
    for(var model in data)
    {
        for(var attribute in data[model])
        {
            $('#'+model+'_'+attribute).html(data[model][attribute]);
        }
    }
}
");
Yii::app()->clientScript->registerScript('radioGroup', "
    $( '#radiogroup_reg' ).buttonset();
    var initUserForm = function (){
        var registerNewCustomer = $('#radiogroup_reg :radio:checked').val();
        if(registerNewCustomer==1)
        {
            $('#user_id_form').hide('slow');
            $('#register_user_form').show('slow');
            $('#Orders_register_new_customer_0').attr('checked',false);
            $('#Orders_register_new_customer_1').attr('checked',true);
        }
        else
        {
            $('#user_id_form').show('slow');
            $('#register_user_form').hide('slow');
            $('#Orders_register_new_customer_1').attr('checked',false);
            $('#Orders_register_new_customer_0').attr('checked',true);
        }
        $('#user_id_form').css('overflow','');
        $('#register_user_form').css('overflow','');
    };
    initUserForm();
    $('#radiogroup_reg input[type=radio]').click(function () {
        initUserForm();
    });
");

?>
    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model,$user,$profile), null, null, array('class'=>'alert alert-danger')); ?>

        <div class="row form-group">
		<?php echo $form->labelEx($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'web_shop_id',WebShops::listData(),
                        array('class'=>'form-control',
                              'ajax' => array(
                                    'type'=>'POST', //request type
                                    'url'=>CController::createUrl($this->id.'/updateFields'), //url to call.
                                    'success'=>'updateFields',   
                                    'dataType'=>'json',
                                    ))); ?>
		<?php echo $form->error($model,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'language_code',Languages::listData(),
                        array('class'=>'form-control',
                              'ajax' => array(
                                    'type'=>'POST', //request type
                                    'url'=>CController::createUrl($this->id.'/updateFields'), //url to call.
                                    'success'=>'updateFields',   
                                    'dataType'=>'json',
                                    ))); ?>
		<?php echo $form->error($model,'language_code',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'currency_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'currency_id',Currencies::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group" id="radiogroup_reg">
            <?php echo $form->radioButtonList($model, 'register_new_customer', 
                    array(
                        $model::USE_EXISTING_CUSTOMER=>Yii::t('common', 'For Existing Customer'),
                        $model::REGISTER_THE_NEW_CUSTOMER=>Yii::t('common', 'Register the new Customer')
                        ),
                    array(
                        'uncheckValue'=>NULL,
                        'separator'=>'',
                    )
                    );?>
        </div>
	<div class="row form-group" id="user_id_form">
		<?php echo $form->labelEx($model,'user_id',array('class'=>'control-label')); ?>
                <?php echo $form->hiddenField($model, 'user_id'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                        'name'=>'user_label',
                        'source'=>Yii::app()->createUrl('ajax/findUser'),
                        'value' => !$model->user_id ? '': customer($model->user_id),
                        // additional javascript options for the autocomplete plugin
                        'options'=>array(
                            'minLength'=>'3',
                            'autoFill'=>false,
                            'select'=>'js:function( event, ui ) {
                                $("#'.CHtml::activeId($model,'user_id').'")
                                .val(ui.item.value);
                                $( "#user_label" ).val( ui.item.label );
                                return false;
                            }',
                            'change'=>'js:function( event, ui ) {
                                if(!$( "#user_label" ).val())
                                {
                                    $("#'.CHtml::activeId($model,'user_id').'")
                                    .val(null);
                                }
                                return false;
                            }',
                        ),
                        'htmlOptions'=>array(
                            'class'=>'form-control',
                            'autocomplete'=>'off',
                            'placeholder'=>Yii::t('common', 'Please, type username or email here...'),
                        ),
                    ));
                ?>
		<?php echo $form->error($model,'user_id',array('class'=>'label label-danger')); ?>
	</div>
        <div id="register_user_form" style="display: none;">
            <?php echo $this->renderPartial('_register_user',array('model'=>$user,'profile'=>$profile,'form'=>$form));?>
        </div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_number',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
                <?php $webShopId = $model->web_shop_id?$model->web_shop_id:key(WebShops::listData()); ?>
		<?php echo $form->labelEx($model,'payment_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'payment_method_id',PaymentMethods::listData(null,$webShopId),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'payment_method_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'shipping_method_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'shipping_method_id',ShippingMethods::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shipping_method_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_outer_status',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'order_outer_status',OrderStatuses::listPublicData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_outer_status',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_inner_status',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'order_inner_status',OrderStatuses::listSystemData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_inner_status',array('class'=>'label label-danger')); ?>
	</div>
        
	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_paid',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'order_paid'); ?>
		<?php echo $form->error($model,'order_paid',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'order_tracking_number',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_tracking_number',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_tracking_number',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <p class="note"><?php echo Yii::t('common','Order items');?></p>
        <div class="row form-group">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'dataProvider'=>$orderItems,
                    'id'=>'orderItems_list',
                    'columns'=>array(
                        array(
                            'name'=>'product_sku',
                            'header'=>Yii::t('common', 'Product SKU'),
                            'value'=>'$data->getProductSKU()',
                            'footer'=>add_product(),
                        ),
                        array(
                            'name'=>'product_quantity',
                            'header'=>Yii::t('common', 'Product Quantity'),
                            'value'=>'$data->product_quantity',
                        ),
                        array(
                            'name'=>'product_final_price',
                            'header'=>Yii::t('common', 'Total'),
                            'value'=>'$data->product_final_price',
                        ),
                        array
                        (
                            'class'=>'CButtonColumn',
                            'template'=>'{delete}',
                            'buttons'=>array
                            (
                                'delete' => array
                                (
                                    'url'=>'Yii::app()->createUrl("ajax/removeItemFromCart",array("itemId"=>$data->temp_id))',
                                )
                            ),
                        )
                    ),
            )); ?>
        </div>
        <div class="row form-group">
            <div class="label label-danger" id="add_product_errors"></div>
        </div>
        <div id="add_product_form" style="display: none;">
            <div class="row form-group">
                <?php echo $form->labelEx($orderItem,'product_id',array('class'=>'control-label')); ?>
                <?php echo $form->hiddenField($orderItem,'product_id'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                        'name'=>'product_label',
                        'source'=>Yii::app()->createUrl('ajax/findProduct'),
                        'value' =>null,
                        // additional javascript options for the autocomplete plugin
                        'options'=>array(
                            'minLength'=>'3',
                            'autoFill'=>false,
                            'select'=>'js:function( event, ui ) {
                                $("#'.CHtml::activeId($orderItem,'product_id').'")
                                .val(ui.item.value);
                                $( "#product_label" ).val( ui.item.label );
                                return false;
                            }',
                            'change'=>'js:function( event, ui ) {
                                if(!$( "#product_label" ).val())
                                {
                                    $("#'.CHtml::activeId($orderItem,'product_id').'")
                                    .val(null);
                                }
                                return false;
                            }',
                        ),
                        'htmlOptions'=>array(
                            'class'=>'form-control',
                            'autocomplete'=>'off',
                            'placeholder'=>Yii::t('common', 'Please, type SKU or Product Name here...'),
                        ),
                    ));
                ?>
                <?php echo $form->error($orderItem,'product_id',array('class'=>'label label-danger')); ?>
            </div>
            <div class="row form-group">
                    <?php echo $form->labelEx($orderItem,'product_quantity',array('class'=>'control-label')); ?>
                    <?php echo $form->textField($orderItem,'product_quantity',array('class'=>'form-control')); ?>
                    <?php echo $form->error($orderItem,'product_quantity',array('class'=>'label label-danger')); ?>
            </div>
            <div class="row form-group buttons">
		<?php echo CHtml::ajaxSubmitButton(Yii::t('common', 'Add'),
                        Yii::app()->createUrl('ajax/addProductToCart'),
                        array(
                            'success'=>'function(html){$("#add_product_form").hide("slow"); '
                                                . '$.fn.yiiGridView.update("orderItems_list");'
                            . '$("#add_product_errors").hide().html("");'
                            . 'if (html.indexOf("{")==0) {
                                    var e = $.parseJSON(html);
                                    $.each(e, function(key, value) {
                                    $("#add_product_errors").show("slow").append(value.toString()+"<br>").attr("style","");
                                    });}}',
                            'error'=>'function(jqXHR, textStatus, errorThrown){'
                            . 'alert(textStatus+": "+errorThrown);'
                            . '}',
                            ),
                        array('class'=>'btn btn-primary')); ?>
            </div>
        </div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($model,'order_coupon_code',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'order_coupon_code',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'order_coupon_code',array('class'=>'label label-danger')); ?>
	</div>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'manager_note',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'manager_note',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'manager_note',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'magnet_msg_sent',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'magnet_msg_sent'); ?>
		<?php echo $form->error($model,'magnet_msg_sent',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'deleted',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
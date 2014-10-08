<div class="row form-group">
        <?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control','autocomplete'=>'off')); ?>
        <?php echo $form->error($model,'username',array('class'=>'label label-danger')); ?>
</div>

<div class="row form-group">
        <?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control','autocomplete'=>'off')); ?>
        <?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
</div>
<?php 
		$profileFields=Profile::getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row form-group">
		<?php echo $form->labelEx($profile,$field->varname,array('class'=>'control-label')); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->varname==='delivery_country_code') {
			echo $form->dropDownList($profile,$field->varname,Countries::listData(),
                                array('class'=>'form-control',
                                      'ajax' => array(
                                            'type'=>'POST', //request type
                                            'url'=>CController::createUrl('ajax/updateDeliveryStates'), //url to call.
                                            'update'=>'#'.CHtml::activeId($profile, 'delivery_state_id'),
//                                            'dataType'=>'json',  
                                       )));
		} elseif ($field->varname==='delivery_state_id') {
			echo $form->dropDownList($profile,$field->varname,States::listData(),array('class'=>'form-control','autocomplete'=>'off'));
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range),array('class'=>'form-control','autocomplete'=>'off'));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control','autocomplete'=>'off'));
		} else {
			echo $form->textField($profile,$field->varname,array('class'=>'form-control','autocomplete'=>'off', 'size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname,array('class'=>'label label-danger')); ?>
	</div>
			<?php
			}
		}
?>
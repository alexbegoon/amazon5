<div class="container">
    <div class="form">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">

<?php echo CHtml::beginForm(); ?>

	<p class="note alert alert-warning"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>
	
	<div class="row form-group varname">
		<?php echo CHtml::activeLabelEx($model,'varname',array('class'=>'control-label')); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'varname',array('class'=>'form-control','size'=>60,'maxlength'=>50,'readonly'=>true)):CHtml::activeTextField($model,'varname',array('class'=>'form-control','size'=>60,'maxlength'=>50))); ?>
		<?php echo CHtml::error($model,'varname',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>

	<div class="row form-group title">
		<?php echo CHtml::activeLabelEx($model,'title',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'title',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'title',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Field name on the language of "sourceLanguage".'); ?></p>
	</div>

	<div class="row  form-group field_type">
		<?php echo CHtml::activeLabelEx($model,'field_type',array('class'=>'control-label')); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_type',array('class'=>'form-control','size'=>60,'maxlength'=>50,'readonly'=>true,'id'=>'field_type')):CHtml::activeDropDownList($model,'field_type',ProfileField::itemAlias('field_type'),array('class'=>'form-control','id'=>'field_type'))); ?>
		<?php echo CHtml::error($model,'field_type',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Field type column in the database.'); ?></p>
	</div>

	<div class="row form-group field_size">
		<?php echo CHtml::activeLabelEx($model,'field_size',array('class'=>'control-label')); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_size',array('class'=>'form-control','readonly'=>true)):CHtml::activeTextField($model,'field_size',array('class'=>'form-control'))); ?>
		<?php echo CHtml::error($model,'field_size',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Field size column in the database.'); ?></p>
	</div>

	<div class="row form-group field_size_min">
		<?php echo CHtml::activeLabelEx($model,'field_size_min',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'field_size_min',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'field_size_min',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('The minimum value of the field (form validator).'); ?></p>
	</div>

	<div class="row form-group required">
		<?php echo CHtml::activeLabelEx($model,'required',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeDropDownList($model,'required',ProfileField::itemAlias('required'),array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'required',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Required field (form validator).'); ?></p>
	</div>

	<div class="row form-group match">
		<?php echo CHtml::activeLabelEx($model,'match',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'match',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'match',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t("Regular expression (example: '/^[A-Za-z0-9\s,]+$/u')."); ?></p>
	</div>

	<div class="row form-group range">
		<?php echo CHtml::activeLabelEx($model,'range',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'range',array('size'=>60,'maxlength'=>5000,'class'=>'form-control',)); ?>
		<?php echo CHtml::error($model,'range',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).'); ?></p>
	</div>

	<div class="row form-group error_message">
		<?php echo CHtml::activeLabelEx($model,'error_message',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'error_message',array('size'=>60,'maxlength'=>255,'class'=>'form-control',)); ?>
		<?php echo CHtml::error($model,'error_message',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Error message when you validate the form.'); ?></p>
	</div>

	<div class="row form-group other_validator">
		<?php echo CHtml::activeLabelEx($model,'other_validator',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'other_validator',array('size'=>60,'maxlength'=>255,'class'=>'form-control',)); ?>
		<?php echo CHtml::error($model,'other_validator',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('file'=>array('types'=>'jpg, gif, png'))))); ?></p>
	</div>

	<div class="row form-group default">
		<?php echo CHtml::activeLabelEx($model,'default',array('class'=>'control-label')); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255,'readonly'=>true,'class'=>'form-control',)):CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255,'class'=>'form-control',))); ?>
		<?php echo CHtml::error($model,'default',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('The value of the default field (database).'); ?></p>
	</div>

	<div class="row form-group widget">
		<?php echo CHtml::activeLabelEx($model,'widget',array('class'=>'control-label')); ?>
		<?php 
		list($widgetsList) = ProfileFieldController::getWidgets($model->field_type);
		echo CHtml::activeDropDownList($model,'widget',$widgetsList,array('id'=>'widgetlist','class'=>'form-control',));
		//echo CHtml::activeTextField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'widget',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Widget name.'); ?></p>
	</div>

	<div class="row form-group widgetparams">
		<?php echo CHtml::activeLabelEx($model,'widgetparams',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'id'=>'widgetparams','class'=>'form-control',)); ?>
		<?php echo CHtml::error($model,'widgetparams',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('param1'=>array('val1','val2'),'param2'=>array('k1'=>'v1','k2'=>'v2'))))); ?></p>
	</div>

	<div class="row form-group position">
		<?php echo CHtml::activeLabelEx($model,'position',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model,'position',array('class'=>'form-control',)); ?>
		<?php echo CHtml::error($model,'position',array('class'=>'label label-danger')); ?>
		<p class="hint label label-primary"><?php echo UserModule::t('Display order of fields.'); ?></p>
	</div>

	<div class="row form-group visible">
		<?php echo CHtml::activeLabelEx($model,'visible',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeDropDownList($model,'visible',ProfileField::itemAlias('visible'),array('class'=>'form-control',)); ?>
		<?php echo CHtml::error($model,'visible',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
</div>
    </div>
<div id="dialog-form" title="<?php echo UserModule::t('Widget parametrs'); ?>">
	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="value">Value</label>
		<input type="text" name="value" id="value" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

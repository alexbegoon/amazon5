<div class="container">
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-8 col-lg-3">
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row form-group">
        <?php echo $form->label($model,'id',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'id',array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'varname',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'varname',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'title',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'field_type',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model,'field_type',ProfileField::itemAlias('field_type'),array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'field_size',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'field_size',array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'field_size_min',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'field_size_min',array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'required',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model,'required',ProfileField::itemAlias('required'),array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'match',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'match',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'range',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'range',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'error_message',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'error_message',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'other_validator',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'other_validator',array('size'=>60,'maxlength'=>5000,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'default',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'default',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'widget',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'widget',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'widgetparams',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'position',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'position',array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'visible',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model,'visible',ProfileField::itemAlias('visible'),array('class'=>'form-control')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(UserModule::t('Search'),array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
</div>
</div>
</div>
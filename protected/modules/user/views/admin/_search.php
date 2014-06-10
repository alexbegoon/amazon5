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
        <?php echo $form->label($model,'username',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'activkey',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'create_at',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'create_at',array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'lastvisit_at',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'lastvisit_at',array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'superuser',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatus'),array('class'=>'form-control')); ?>
    </div>

    <div class="row form-group">
        <?php echo $form->label($model,'status',array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model,'status',$model->itemAlias('UserStatus'),array('class'=>'form-control')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(UserModule::t('Search'),array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
</div>
</div>
</div>
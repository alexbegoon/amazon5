<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
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

	<?php echo $form->errorSummary(array($model,$categoryImages,$categoryTranslations,$categoryCategories), null, null, array('class'=>'alert alert-danger')); ?>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'web_shop_id',  WebShops::listData(),
                        array('class'=>'form-control',
                              'options'=>array(Yii::app()->request->getParam('web_shop_id',0)=>array('selected'=>true)),
                              'prompt'=>'- '.Yii::t('common', 'Select WebShop').' -',  
                                'ajax' => array(
                                    'type'=>'POST', //request type
                                    'url'=>CController::createUrl($this->id.'/CategoryTreeOptions'), //url to call.
                                    //Style: CController::createUrl('currentController/methodToCall')
                                    'update'=>'#CategoryCategories_parent_id', //selector to update
                            ))); ?>
		<?php echo $form->error($model,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'language_code',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($categoryTranslations,'language_code', Languages::listData(),array('class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'language_code',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'category_name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryTranslations,'category_name',array('size'=>45,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'category_name',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'category_s_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($categoryTranslations,'category_s_desc',array('maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'category_s_desc',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'category_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($categoryTranslations,'category_desc',array('class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'category_desc',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'meta_desc',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryTranslations,'meta_desc',array('size'=>45,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'meta_desc',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'meta_keywords',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryTranslations,'meta_keywords',array('size'=>45,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'meta_keywords',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'custom_title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryTranslations,'custom_title',array('size'=>45,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'custom_title',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryTranslations,'slug',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryTranslations,'slug',array('size'=>45,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($categoryTranslations,'slug',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryImages,'image',array('class'=>'control-label')); ?>
		<?php echo CHtml::activeFileField($categoryImages, 'image'); ?>
		<?php echo $form->error($categoryImages,'image',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryImages,'image_url',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryImages,'image_url',array('class'=>'form-control')); ?>
		<?php echo $form->error($categoryImages,'image_url',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryImages,'thumb_width',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryImages,'thumb_width',array('class'=>'form-control')); ?>
		<?php echo $form->error($categoryImages,'thumb_width',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryImages,'thumb_height',array('class'=>'control-label')); ?>
		<?php echo $form->textField($categoryImages,'thumb_height',array('class'=>'form-control')); ?>
		<?php echo $form->error($categoryImages,'thumb_height',array('class'=>'label label-danger')); ?>
	</div>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryImages,'thumb_quality',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($categoryImages,'thumb_quality', CategoryImages::listQualities(),array('class'=>'form-control')); ?>
		<?php echo $form->error($categoryImages,'thumb_quality',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        <div class="row form-group">
		<?php echo $form->labelEx($categoryCategories,'parent_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($categoryCategories,'parent_id', CHtml::listData(
                                                                                    Categories::model()->getCategoryTreeArr(
                                                                                            Yii::app()->request->getParam('web_shop_id',null)), 'category_id', 'category_name'),
                        array('class'=>'form-control',
                              'options'=>array(Yii::app()->request->getParam('parent_id',0)=>array('selected'=>true)))); ?>
		<?php echo $form->error($categoryCategories,'parent_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'published',array('class'=>'control-label')); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'outer_category_id',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'outer_category_id',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'outer_category_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $this->widget('TinyMCE',array(
    'options'=>array(
        'selector'=>'#CategoryTranslations_category_desc',
    ),
));?>
</div>
</div>
</div>
<!-- form -->
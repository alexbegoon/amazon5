<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>
<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-move-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($categoryCategories), null, null, array('class'=>'alert alert-danger')); ?>

	
        <div class="row form-group">
		<?php echo $form->labelEx($categoryCategories,'parent_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($categoryCategories,'parent_id', CHtml::listData(
                                                                                    Categories::model()->getCategoryTreeArr(
                                                                                            Yii::app()->request->getParam('web_shop_id',null)), 'category_id', 'category_name'),
                        array('class'=>'form-control',
                              'options'=>array(Yii::app()->request->getParam('parent_id',0)=>array('selected'=>true)))); ?>
		<?php echo $form->error($categoryCategories,'parent_id',array('class'=>'label label-danger')); ?>
	</div>

	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div>
<!-- form -->
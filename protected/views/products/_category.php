<?php
/* @var $this ProductsController */
/* @var $model ProductCategories */
/* @var $form CActiveForm */
?>

<div class="container">
<div class="form">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-category-_category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note alert alert-warning"><?php echo Yii::t('common','Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary(array($model), null, null, array('class'=>'alert alert-danger')); ?>

        <?php echo $form->hiddenField($model,'product_id',array('class'=>'form-control')); ?>

        <div class="row form-group">
		<?php echo $form->labelEx($category,'web_shop_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($category,'web_shop_id',  WebShops::listData(),
                        array('class'=>'form-control',
                              'options'=>array(Yii::app()->request->getParam('web_shop_id',0)=>array('selected'=>true)),
                              'prompt'=>'- '.Yii::t('common', 'Select WebShop').' -',  
                                'ajax' => array(
                                    'type'=>'POST', //request type
                                    'url'=>CController::createUrl('categories/CategoryTreeOptions'), //url to call.
                                    //Style: CController::createUrl('currentController/methodToCall')
                                    'update'=>'#ProductCategories_category_id', //selector to update
                            ))); ?>
		<?php echo $form->error($category,'web_shop_id',array('class'=>'label label-danger')); ?>
	</div>
        
        <div class="row form-group">
		<?php echo $form->labelEx($model,'category_id',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'category_id', CHtml::listData(
                                                                                    Categories::model()->getCategoryTreeArr(
                                                                                            $category->web_shop_id), 'category_id', 'category_name'),
                        array('class'=>'form-control',
                              'options'=>array(Yii::app()->request->getParam('parent_id',0)=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'category_id',array('class'=>'label label-danger')); ?>
	</div>
        <hr>
        
	<div class="row form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Assign') : Yii::t('common', 'Save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div>
</div><!-- form -->
<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	Yii::t('common','Countries')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Countries'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Countries'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Countries'), 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Countries'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Countries'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Countries')?> <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'name',
		'full_name',
		'iso3',
		'number',
		'continent_code',
		array(
                    'name'=>'published',
                    'type'=>'html',
                    'value'=>$model->published==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Unpublish")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Publish"))),
                ),
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->modified_by)->getFullName(),
                ),
		'locked_on',
		'locked_by',
	),
)); ?>

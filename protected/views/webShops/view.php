<?php
/* @var $this WebShopsController */
/* @var $model WebShops */

$this->breadcrumbs=array(
	'Web Shops'=>array('index'),
	$model->shop_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','WebShops'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','WebShops'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','WebShops'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','WebShops'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','WebShops'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'WebShops')?> #<?php echo $model->shop_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shop_name',
		'shop_code',
		'template_name',
		'shop_url',
                array(
                    'name'=>'default_language',
                    'value'=>  Languages::listData($model->default_language),
                ),
                array(
                    'name'=>'currency_id',
                    'value'=>  Currencies::listData($model->currency_id),
                ),
                array(
                    'name'=>'offline',
                    'type'=>'html',
                    'value'=>$model->offline==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("offline"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "No")))               
                                               :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("offline"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "Yes"))),
                ),
		'email',
		'email_header',
		'email_footer',
		'email_subject',
		'admin_email',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'locked_on',
		'locked_by',
	),
)); ?>

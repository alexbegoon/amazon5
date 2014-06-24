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
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','WebShops'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('common','Are you sure you want to delete this item?'))),
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
		'default_language',
		'currency_id',
		'offline',
		'email',
		'email_header',
		'email_footer',
		'email_subject',
		'admin_email',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
	),
)); ?>

<?php
/* @var $this ShippingCompaniesController */
/* @var $model ShippingCompanies */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Companies')=>array('index'),
	$model->company_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Shipping Companies'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Company'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Shipping Company'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Shipping Company'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Companies'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> #<?php echo $model->company_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_name',
		'company_desc',
		'company_website',
                'tracking_number_format',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> created_by($model),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> modified_by($model),
                ),
	),
)); ?>

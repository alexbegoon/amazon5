<?php
/* @var $this TaxesController */
/* @var $model Taxes */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Taxes')=>array('index'),
	Countries::listData($model->country_code),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Taxes'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Tax'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Tax'), 'url'=>array('update', 'id'=>$model->country_code)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Tax'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->country_code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Taxes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Taxes')?> #<?php echo Countries::listData($model->country_code); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'name'=>'country_code',
                    'value'=>Countries::listData($model->country_code)
                ),
		'vat',
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

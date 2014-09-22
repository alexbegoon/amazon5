<?php
/* @var $this FeesController */
/* @var $model Fees */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Fees')=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Fees'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Fee'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Fee'), 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Fee'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Fees'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Fee')?> #<?php echo $model->code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code',
		'fee_type',
		'fee_mode',
		'percent',
                array(
                    'name'=>'amount',
                    'value'=>  Currencies::priceDisplay($model->amount, $model->currency_id),
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
	),
)); ?>

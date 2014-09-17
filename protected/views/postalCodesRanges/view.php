<?php
/* @var $this PostalCodesRangesController */
/* @var $model PostalCodesRanges */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Postal Codes Ranges')=>array('index'),
	$model->range_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Range of the Postal Codes')?> '<?php echo $model->range_name; ?>'</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'range_name',		
                array(
                    'name'=>'country_code',
                    'value'=>  Countries::listData($model->country_code),
                ),
		'postal_code_from',
		'postal_code_to',
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

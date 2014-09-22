<?php
/* @var $this TaxesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Taxes'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Tax'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Taxes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Taxes')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
                array(
                    'name'=>'country_code',
                    'value'=>'Countries::listData($data->country_code)',
                ),
		'vat',
                'created_on',
                array(
                    'name'=>  'created_by',
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
                'modified_on',
                array(
                    'name'=>  'modified_by',
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
                ),
        ),
)); ?>

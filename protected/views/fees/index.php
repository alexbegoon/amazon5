<?php
/* @var $this FeesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Fees'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Fee'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Fees'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Fees')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'code',
            'fee_type',
            'fee_mode',
            'percent',
            array(
                'name'=>'amount',
                'value'=>  'Currencies::priceDisplay($data->amount, $data->currency_id)'
            ),
            'created_on',
            array(
                'name'=>  'created_by',
                'value'=> 'created_by($data)',
            ),
            'modified_on',
            array(
                'name'=>  'modified_by',
                'value'=> 'modified_by($data)',
            ),
        ),
)); ?>

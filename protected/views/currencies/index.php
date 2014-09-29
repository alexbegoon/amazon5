<?php
/* @var $this CurrenciesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Currencies'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Currencies'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Currencies'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Currencies')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'currency_name',
            'currency_code_2',
            'currency_code_3',
            'currency_numeric_code',
            'currency_exchange_rate',
            'currency_symbol',
            'currency_decimal_place',
            'currency_decimal_symbol',
            'currency_thousands',
            'currency_positive_style',
            'currency_negative_style',
            array(
                'name'=>'published',
                'value'=>'boolean($data)',
            ),
            array(
                'name'=>'created_by',
                'value'=>'created_by($data)',
            ),
            'created_on',
            
            array(
                'name'=>'modified_by',
                'value'=>'modified_by($data)',
            ),
            'modified_on',
        ),
)); ?>

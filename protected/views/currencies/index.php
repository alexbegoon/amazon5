<?php
/* @var $this CurrenciesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Currencies',
);

$this->menu=array(
	array('label'=>'Create Currencies', 'url'=>array('create')),
	array('label'=>'Manage Currencies', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Currencies</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
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
                'value'=>'$data->published==1?"Yes":"No"',
            ),
            array(
                'name'=>'created_by',
                'value'=>'Yii::app()->getModule(\'user\')->user($data->created_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->created_by)->profile->getAttribute(\'lastname\')',
            ),
            'created_on',
            
            array(
                'name'=>'modified_by',
                'value'=>'Yii::app()->getModule(\'user\')->user($data->modified_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->modified_by)->profile->getAttribute(\'lastname\')',
            ),
            'modified_on',
            array(
                'name'=>'lock',
                'type'=>'html',
                'value'=>'$data->locked_by!=0?"<span class=\"glyphicon glyphicon-lock\" title=\"Locked by ". Yii::app()->getModule(\'user\')->user($data->locked_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->locked_by)->profile->getAttribute(\'lastname\')."\"></span>":""',                
            ),
        ),
)); ?>

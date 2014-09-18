<?php
/* @var $this PostalCodesRangesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Ranges of the Postal Codes'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Range of the Postal Codes'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Ranges of the Postal Codes'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Ranges of the Postal Codes')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'range_name',
            array(
                'name'=>'country_code',
                'value'=>'Countries::listData($data->country_code)',
            ),
            'postal_code_from',
            'postal_code_to',
            array(
                'name'=>'created_by',
                'value'=>'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
            ),
            'created_on',
            array(
                'name'=>'modified_by',
                'value'=>'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
            ),
            'modified_on',
        ),
)); ?>

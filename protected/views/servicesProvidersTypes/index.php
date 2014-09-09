<?php
/* @var $this ServicesProvidersTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Types of the service providers'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Type of the service provider'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Types of the service providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Types of the service providers')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'type',
            'description',
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

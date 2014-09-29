<?php
/* @var $this ShippingTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Types'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Type'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Types'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Shipping Types')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'shipping_type_name',
            'shipping_type_desc',
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

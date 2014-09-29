<?php
/* @var $this OrderStatusesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Order Statuses'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order Status'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Order Statuses'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Order Statuses')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'status_code',
            array(
                'name'=>Yii::t('common', 'Status Name'),
                'value'=>'$data->getName()',
            ),
            array(
                'name'=>'published',
                'value'=>'boolean($data)',
            ),
            array(
                'name'=>'public',
                'value'=>'boolean($data,"public")',
            ),
            array(
                'name'=>'notify_customer_if_applied',
                'value'=>'boolean($data,"notify_customer_if_applied")',
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

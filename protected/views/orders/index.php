<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Orders'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Orders'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Orders')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'user_id',
            'order_number',
            'order_pass',
            'order_total',
            'order_outer_status',
            'order_inner_status',
            'order_tracking_number',
            'web_shop_id',
        ),
)); ?>

<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */

$this->breadcrumbs=array(
	Yii::t('common','Order Statuses')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Order Statuses'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order Status'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Order Statuses')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-statuses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'status_code',
                array(
                    'name'=>'status_name',
                    'value'=>'$data->getName()',
                ),
		array(
                    'name'=>'published',
                    'value'=>'OrderStatuses::itemAlias("Published",$data->published)',
                    'filter'=>OrderStatuses::itemAlias("Published"),
		),
                array(
                    'name'=>'public',
                    'value'=>'OrderStatuses::itemAlias("Public",$data->public)',
                    'filter'=>OrderStatuses::itemAlias("Public"),
		),
                array(
                    'name'=>'notify_customer_if_applied',
                    'value'=>'OrderStatuses::itemAlias("Notify Customer If Applied",$data->notify_customer_if_applied)',
                    'filter'=>OrderStatuses::itemAlias("Notify Customer If Applied"),
		),
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}&nbsp;&nbsp;&nbsp;{delete}'
		),
	),
)); ?>

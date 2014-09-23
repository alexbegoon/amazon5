<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
        Yii::t('common', 'Payment')=>array('payment/index'),
	Yii::t('common','Payment Methods')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Payment Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Payment Method'), 'url'=>array('create')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Payment Methods')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-methods-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
                    'header'=>Yii::t('common', 'Payment Method Name'),
                    'name'=>'payment_method_name',
                    'value'=>'$data->getName()',
		),
		array(
                    'name'=>'published',
                    'value'=>'PaymentMethods::itemAlias("Published",$data->published)',
                    'filter'=>PaymentMethods::itemAlias("Published"),
		),
		array(
                    'name'=>'handler_component',
                    'filter'=>  enumItem($model, 'handler_component'),
		),
		'created_on',
		'modified_on',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}&nbsp;&nbsp;&nbsp;{delete}'
		),
	),
)); ?>

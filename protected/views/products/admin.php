<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Products'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Batch Upload Images'), 'url'=>array('batchUploadImages')),
	array('label'=>Yii::t('common','Statistic'), 'url'=>array('statistic')),
);

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Products')?></h1>



<?php 

//CVarDumper::dump($model->search()->getData(),10,true);die;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'product_sku',
                array(
                    'name'=>'product_name',
                    'value'=>'$data->name',                    
                ),
                array(
                    'name'=>'manufacturer_id',
                    'value'=>'$data->manufacturer_id?Manufacturers::listData($data->manufacturer_id):Yii::t("common","*no name*")',
                    'filter'=>Manufacturers::listData(),
                ),
		array(
			'name'=>'newly_created',
			'value'=>'Products::itemAlias("Newly Created",$data->newly_created)',
			'filter'=>Products::itemAlias("Newly Created"),
		),
		array(
			'name'=>'published',
			'value'=>'Products::itemAlias("Published",$data->published)',
			'filter'=>Products::itemAlias("Published"),
		),
		array(
			'name'=>'blocked',
			'value'=>'Products::itemAlias("Blocked",$data->blocked)',
			'filter'=>Products::itemAlias("Blocked"),
		),
		'created_on',
		/*
		'created_by',
		'modified_on',
		'modified_by',
		'locked_on',
		'locked_by',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}&nbsp;&nbsp;&nbsp;{delete}',
		),
	),
)); ?>

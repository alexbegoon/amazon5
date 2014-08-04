<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
        $model->getName()=>array('view','id'=>$model->id),
	Yii::t('common','Products of the category'),
);

$this->menu=array(
//        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Categories'), 'url'=>array('index')),
//	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Categories'), 'url'=>array('admin')),
);
?>
<?php //CVarDumper::dump(Products::model()->findByPk(91)->search(),10,true); ?>
<h1 class="text-center"><?php echo Yii::t('common', 'Products of the category');?> "<?php echo $model->getName()?>"</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$products->search(),
	'filter'=>$products,
	'columns'=>array(
		'id',
		'product_sku',
                array(
                    'name'=>'product_name',
                    'value'=>'$data->name',                    
                ),
                array(
                    'name'=>'manufacturer_id',
                    'value'=>'Manufacturers::listData($data->productManufacturers[0]->id)',
//                    'value'=>'CVarDumper::dump(($data->productManufacturers))',
                    'filter'=>Manufacturers::listData(),
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
                        'buttons'=>array(
                            'view'=>array(
                                'url'=> 'Yii::app()->createUrl("products/view",array("id"=>$data->id))',
                            ),
                            'delete'=>array(
                                'url'=> 'Yii::app()->controller->createUrl("revokeProductFromCategory",array("id"=>'.$model->id.',"product_id"=>$data->id))',
                            ),
                        ),
		),
	),
)); ?>
<?php //$this->renderPartial('_translations', array(  'model'=>$model)); ?>

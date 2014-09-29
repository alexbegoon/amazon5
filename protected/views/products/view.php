<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	'#'.$model->product_sku,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Product'), 'url'=>array('create')),
//        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Product'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Product'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Product')?> #<?php echo $model->product_sku; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_sku',
                array(
                    'name'=>  Yii::t('common', 'Newly Created'),
                    'type'=>'html',
                    'value'=>$model->newly_created==1?Yii::t("yii", "Yes")             
                                                     :Yii::t("yii", "No"),
                ),
                array(
                    'name'=>  Yii::t('common', 'Published'),
                    'type'=>'raw',
                    'value'=>toggle($model),
                ),
		array(
                    'name'=>  Yii::t('common', 'Blocked'),
                    'type'=>'raw',
                    'value'=>toggle($model,'blocked',array("Unblock","Block")),                    
                ),
                array(
                    'name'=>'manufacturer_id',
                    'value'=> Manufacturers::listData($model->manufacturer_id),
                ),
                'product_parent_id',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> created_by($model),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> modified_by($model),
                ),
	),
)); ?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Product Name')?></h3>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('product_id'=>$model->id))),
                ),
                'product_name',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey())',
                        )
                    ),
                )
	),
));
?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Product Description')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('product_id'=>$model->id))),
                ),
                array(
                    'name'=>'product_desc',
                    'type'=>'html',
                ),
                array(
                    'name'=>'product_s_desc',
                    'type'=>'html',
                ),
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey())',
                        )
                    ),
                )
	),
));
?>
<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Categories')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productCategories,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Web Shop'),
                    'value'=> 'WebShops::getNameByPk($data->web_shop_id)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Assign'),Yii::app()->createUrl(Yii::app()->controller->id."/assignToCategory",array('product_id'=>$model->id))),
                ),
                'id',
                array(
                    'name'=>Yii::t('common', 'Category Name'),
                    'value'=>'$data->getName()',
                ),
                array(
                    'name'=>Yii::t('common', 'Category Path'),
                    'value'=>'$data->getPath()',
                ),
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{view}&nbsp;&nbsp;{delete}',
                    'buttons'=>array
                    (
                        'delete' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/unmountCategory",array("product_id"=>'.$model->id.', "category_id"=>$data->id))',
                        ),
                        'view' => array
                        (
                            'url'=>'Yii::app()->createUrl("categories/view",array("id"=>$data->id))',
                        ),
                    ),
                )
	),
));
?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Product Price')?></h3>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productPrices,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Web Shop'),
                    'value'=> 'WebShops::getNameByPk($data->web_shop_id)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createPrice",array('product_id'=>$model->id))),
                ),
                'product_price',
                array(
                    'name'=>  Yii::t('common', 'Currency'),
                    'value'=>  'Currencies::getNameByPk($data->currency_id)',
                ),
                array(
                    'name'=>  Yii::t('common', 'Override'),
                    'value'=>  '$data->override==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
                ),
                'product_override_price',
                'product_tax_id',
                'product_discount_id',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/updatePrice",array("id"=>$data->id))',
                        )
                    ),
                )
	),
));
?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Product Meta Information')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('product_id'=>$model->id))),
                ),
                'meta_desc', 
                'meta_keywords', 
                'custom_title', 
                'slug',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey())',
                        )
                    ),
                )
	),
));
?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Product Sources')?></h3>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productProviders,
	'columns'=>array(
                array(
                    'header'=>Yii::t('common', 'Provider Name'),
                    'name'=>'provider_name',
                    'value'=>  'Providers::getNameById($data->provider_id)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createSource",array('product_id'=>$model->id))),        
                ),	
                'provider_product_name',
                array(
                    'header'=>  Yii::t('common', 'Provider Price'),
                    'name'=> 'provider_price',
                    'value'=> 'Currencies::priceDisplay($data->provider_price,$data->currency_id)',
                ),
                'quantity_in_stock',
                
                array(
                    'header'=>  Yii::t('common', 'Blocked'),
                    'name'=>'blocked',
                    'value'=>  '$data->blocked==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
                ),
                'inner_id',
                'inner_sku',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
                    'buttons'=>array
                    (
                        'delete' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/deleteSource/",array("product_id"=>$data->product_id,"provider_id"=>$data->provider_id))',
                        ),
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/updateSource/",array("product_id"=>$data->product_id,"provider_id"=>$data->provider_id))',
                        )
                    ),
                )
	),
));
?>



<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Product Images')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productImages,
	'columns'=>array(
                array(
                    'name'=>Yii::t('common', 'Image'),
                    'value'=>'$data->popupImage',                  
                    'type'=>'html',
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createImage",array('product_id'=>$model->id))),        
                ),	
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'created_by($data)',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'modified_by($data)',
                ),
                'id',
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{delete}',
                    'buttons'=>array
                    (
                        'delete' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/deleteImage/",array("id"=>$data->id))',
                        )
                    ),
                )
	),
));
?>

<hr>

<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                                'target'=>'a.fancybox-image',
                                'config'=>array(),)
            );
?>
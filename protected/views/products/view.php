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
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Product'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Product'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('common','Are you sure you want to delete this item?'))),
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
                    'name'=>  Yii::t('common', 'Published'),
                    'value'=>$model->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No"),
                ),
		array(
                    'name'=>  Yii::t('common', 'Blocked'),
                    'value'=>$model->blocked==1?Yii::t("yii", "Yes"):Yii::t("yii", "No"),
                ),
                'product_parent_id',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->modified_by)->getFullName(),
                ),
		'locked_on',
		'locked_by',
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
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
                ),
                array(
                    'name'=>'',
                    'type'=>'html',
                    'value'=>'CHtml::link(Yii::t("common", "Update"),Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey()))',
                ),
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
                'product_desc',
                'product_s_desc',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
                ),
                array(
                    'name'=>'',
                    'type'=>'html',
                    'value'=>'CHtml::link(Yii::t("common", "Update"),Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey()))',
                ),
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
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
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
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
                ),
                array(
                    'name'=>'',
                    'type'=>'html',
                    'value'=>'CHtml::link(Yii::t("common", "Update"),Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey()))',
                ),
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
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
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
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/deleteImage/".$data->id)',
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
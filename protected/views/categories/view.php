<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
	$model->getName(),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Categories'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Categories'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Categories'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Categories'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('common','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Categories'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'Category')?> "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                    'name'=>  Yii::t('common', 'Web Shop'),
                    'value'=> WebShops::getNameByPk($model->web_shop_id),
                ),
		array(
                    'name'=>  Yii::t('common', 'Published'),
                    'value'=>$model->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No"),
                ),
		'hits',
		'outer_category_id',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'locked_on',
		'locked_by',
	),
)); ?>
<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Category Name')?></h3>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$categoryTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('category_id'=>$model->id))),
                ),
                'category_name',
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
<h3 class="text-center"><?php echo Yii::t('common', 'Category Description')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$categoryTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('category_id'=>$model->id))),
                ),
                'category_desc',
                'category_s_desc',
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
<h3 class="text-center"><?php echo Yii::t('common', 'Category Meta Information')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$categoryTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('category_id'=>$model->id))),
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
<h3 class="text-center"><?php echo Yii::t('common', 'Category Images')?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$categoryImages,
	'columns'=>array(
                array(
                    'name'=>Yii::t('common', 'Image'),
                    'value'=>'$data->popupImage',                  
                    'type'=>'html',
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createImage",array('category_id'=>$model->id))),        
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
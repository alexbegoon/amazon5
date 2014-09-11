<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	Yii::t('common','Categories')=>array('index'),
	$model->getName(),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Categories'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Category'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Category'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
        array('label'=>Yii::t('common','Products of the category'), 'url'=>$this->createUrl('products',array('id'=>$model->id)))
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
                    'type'=>'html',
                    'value'=>$model->published==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Unpublish")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Publish"))),
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
                    'value'=> Yii::app()->getModule("user")->user($model->modified_by)->getFullName(),
                ),
		'locked_on',
		'locked_by',
        )
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
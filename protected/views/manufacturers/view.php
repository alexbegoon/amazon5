<?php
/* @var $this ManufacturersController */
/* @var $model Manufacturers */

$this->breadcrumbs=array(
	Yii::t('common','Manufacturers')=>array('index'),
	$model->getName()=>$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Manufacturers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Manufacturer'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Manufacturer'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Manufacturer'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Manufacturers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Manufacturer')?> "<?php echo $model->getName(); ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'hits',
		'manufacturer_email',
		'manufacturer_url',
                array(
                    'name'=>  Yii::t('common', 'Published'),
                    'type'=>'raw',
                    'value'=>toggle($model),
                ),
		'created_on',
                array(
                    'name'=>'created_by',
                    'value'=>created_by($model),
                ),
		'modified_on',
		array(
                    'name'=>'modified_by',
                    'value'=>modified_by($model),
                ),
	),
)); ?>

<h3 class="text-center"><?php echo Yii::t('common', 'Available translations for this item.')?></h3>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('manufacturer_id'=>$model->id))),
                ),
        'manufacturer_name',
        'manufacturer_desc',
        'slug',
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
    'enableSorting'=>true,
));

?>

<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	Yii::t('common','Languages')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Languages'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Languages'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Languages'), 'url'=>array('update', 'id'=>$model->lang_code)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Languages'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->lang_code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Languages'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Languages')?> "<?php echo $model->title; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lang_code',
		'title',
		'title_native',
		'sef',
		'image_url',
		'image_url_thumb',
		array(
                    'name'=>'published',
                    'type'=>'raw',
                    'value'=>toggle($model),
                ),
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
		'locked_on',
		'locked_by',
	),
)); ?>

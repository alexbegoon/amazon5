<?php
/* @var $this ContinentsController */
/* @var $model Continents */

$this->breadcrumbs=array(
	Yii::t('common','Continents')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Continents'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Continents'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#continents-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Continents')?></h1>

<p>
    <?php echo Yii::t('common','You may optionally enter a comparison operator');?>    (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) 
    <?php echo Yii::t('common','at the beginning of each of your search values to specify how the comparison should be done.');?>    
</p>

<?php echo CHtml::link(Yii::t('common','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'continents-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'code',
		'name',
            array(
                'name'=>'published',
                'value'=>'$data->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
            ),
            array(
                'name'=>'created_by',
                'value'=>'created_by($data)',
            ),
		'created_on',
            array(
                'name'=>'modified_by',
                'value'=>'modified_by($data)',
            ),
		'modified_on',
		array(
                'name'=>'locked_by',
                'type'=>'html',
                'value'=>'$data->locked_by!=0?"<span class=\"glyphicon glyphicon-lock\" title=\"".Yii::t(\'common\',\'Locked By\')." ". Yii::app()->getModule(\'user\')->user($data->locked_by)->getFullName()."\"></span>":""',                
            ),
            array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

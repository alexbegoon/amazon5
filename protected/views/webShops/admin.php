<?php
/* @var $this WebShopsController */
/* @var $model WebShops */

$this->breadcrumbs=array(
	Yii::t('common','Web Shops')=>array('index'),
	Yii::t('common','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','WebShops'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','WebShops'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#web-shops-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Web Shops')?></h1>

<p>
    <?php echo Yii::t('common','You may optionally enter a comparison operator');?> 
    (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) 
    <?php echo Yii::t('common','at the beginning of each of your search values to specify how the comparison should be done.');?>
</p>

<?php echo CHtml::link(Yii::t('common','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'web-shops-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'shop_name',
		'shop_code',
		'template_name',
		'shop_url',
		'default_language',
		'currency_id',
		'email',
                array(
                    'name'=>'offline',
                    'value'=>'$data->offline==1?"Yes":"No"',
                ),
                array(
                    'name'=>'created_by',
                    'value'=>'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'created_on',

                array(
                    'name'=>'modified_by',
                    'value'=>'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
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

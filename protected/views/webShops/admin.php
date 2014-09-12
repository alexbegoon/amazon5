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

?>

<h1 class="text-center"><?php echo Yii::t('common','Manage');?> <?php echo Yii::t('common','Web Shops')?></h1>


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
		array(
                    'name'=>'currency_id',
                    'value'=>'Currencies::listData($data->currency_id)',
                    'filter'=>Currencies::listData(),
                ),
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

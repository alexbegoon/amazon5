<?php
/* @var $this WebShopsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Web Shops'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','WebShops'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','WebShops'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Web Shops')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
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
                ),
                'email',
                array(
                    'name'=>'offline',
                    'value'=>'$data->offline==1?Yii::t("yii","Yes"):Yii::t("yii","No")',
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
        ),
)); ?>

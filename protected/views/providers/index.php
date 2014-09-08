<?php
/* @var $this ProvidersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Providers'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Providers')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'provider_name',
            'cif',
            'provider_url',
            array(
                'name'=>'provider_country',
                'value'=>'Countries::listData($data->provider_country)',
            ),
            'provider_address',
            'vat',
            array(
                'name'=>Yii::t('common', 'Inactive'),
                'value'=>'$data->inactive==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
            ),
            'sku_format',
            'provider_email',
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
        ),
)); ?>

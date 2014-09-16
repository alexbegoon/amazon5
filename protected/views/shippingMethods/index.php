<?php
/* @var $this ShippingMethodsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Methods'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Method'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Shipping Methods')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            array(
                'name'=>'shipping_company_id',
                'value'=>'ShippingCompanies::listData($data->shipping_company_id)',
            ),
            array(
                'name'=>'shipping_type_id',
                'value'=>'ShippingTypes::listData($data->shipping_type_id)',
            ),
            array(
                'name'=>'published',
                'value'=>'$data->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
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
        ),
)); ?>

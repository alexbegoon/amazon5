<?php
/* @var $this PaymentMethodsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common', 'Payment')=>array('payment/index'),
	Yii::t('common','Payment Methods'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Payment Method'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Payment Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Payment Methods')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            array(
                'name'=>Yii::t('common', 'Payment Method Name'),
                'value'=>'$data->getName()',
            ),
            array(
                'name'=>'web_shop_id',
                'value'=>'WebShops::listData($data->web_shop_id)',
            ),
            'handler_component',
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
        ),
)); ?>

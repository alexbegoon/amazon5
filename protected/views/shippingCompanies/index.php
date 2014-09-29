<?php
/* @var $this ShippingCompaniesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Shipping')=>array('shipping/index'),
	Yii::t('common','Shipping Companies'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Shipping Company'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Shipping Companies'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Shipping Companies')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'company_name',
            'company_desc',
            'company_website',
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

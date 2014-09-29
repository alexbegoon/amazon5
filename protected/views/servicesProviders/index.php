<?php
/* @var $this ServicesProvidersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers of the Services'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider of the Services'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers of the Services'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Providers of the Services')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'provider_name',
            'provider_description',
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

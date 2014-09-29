<?php
/* @var $this CountriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Countries'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Countries'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Countries'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Countries')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=>array(
            'code',
            'name',
            'full_name',
            'iso3',
            'number',
            array(
                'name'=>'continent',
                'value'=>'$data->continentCode->name',
            ),
            array(
                'name'=>'published',
                'value'=>'boolean($data)',
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

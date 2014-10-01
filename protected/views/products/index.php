<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Products'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Products'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),	
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Products')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
            'id',
            'product_sku',
            array(
                'name'=>Yii::t('common', 'Published'),
                'value'=>'boolean($data)',
            ),
            array(
                'name'=>Yii::t('common', 'Blocked'),
                'value'=>'boolean($data,"blocked")',
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

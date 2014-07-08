<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Products'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Products'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
	array('label'=>Yii::t('common','Batch Upload Images'), 'url'=>array('batchUploadImages')),
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
                'value'=>'$data->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
            ),
            array(
                'name'=>Yii::t('common', 'Blocked'),
                'value'=>'$data->blocked==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
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

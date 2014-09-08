<?php
/* @var $this ProductsController */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
        Yii::t('common','Statistics')=>array('statistic'),
	Yii::t("common", "View products without description"),
	Yii::t("common", $language_name),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Products'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t("common", "View products without description");?></h1>

<h4><?php echo Yii::t('common', 'Products without description')?></h4>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productsWithoutDescription,
        'columns'=>array(
            'id',
            'product_sku',
            array(
                'name'=>Yii::t('common', 'Published'),
                'value'=>'$data->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
            ),
            'created_on',
            array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
                )
        ),
    ));

?>

<hr>
<h4><?php echo Yii::t('common', 'Products without short description')?></h4>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productsWithoutShortDescription,
        'columns'=>array(
            'id',
            'product_sku',
            array(
                'name'=>Yii::t('common', 'Published'),
                'value'=>'$data->published==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
            ),
            'created_on',
            array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
                )
        ),
    ));
?>
<hr>
<?php
/* @var $this ProductsController */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	Yii::t('common','Statistics'),
);

$this->menu=array(
        array('label'=>Yii::t('common','List') .' '. Yii::t('common','Products'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Products'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Products'), 'url'=>array('admin')),
);
?>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                                'target'=>'a.fancybox-image',
                                'config'=>array(),)
            );
?>

<h1 class="text-center"><?php echo Yii::t('common','Statistics');?></h1>

<div>
    <ul>
        
        <li>
            <?php echo Yii::t('common', 'Total products')?>: <?php echo $totalProducts;?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Newly Created');?>: <?php echo $productsNewlyCreated->totalItemCount ;?>
            <?php echo CHtml::link(Yii::t('common', 'See'), '#', array(
                        'onclick'=>'$("#mydialog_newly_created").dialog("open"); return false;',
                     ));?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Images path')?>: <code><?php echo $imagesPath;?></code>
        </li>
        <li>
            <?php echo Yii::t('common', 'Total image files');?>: <?php echo $totalImageFiles;?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Not assigned images');?>: <?php echo count($notAssignedImages);?> 
            <?php echo CHtml::link(Yii::t('common', 'See'), '#', array(
                        'onclick'=>'$("#mydialog_notassigned").dialog("open"); return false;',
                     ));?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Lost image files');?>: <?php echo count($lostFiles);?>
            <?php echo CHtml::link(Yii::t('common', 'See'), '#', array(
                        'onclick'=>'$("#mydialog_lostfiles").dialog("open"); return false;',
                     ));?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Products without image');?>: <?php echo $productsWithoutImage->totalItemCount ;?>
            <?php echo CHtml::link(Yii::t('common', 'See'), '#', array(
                        'onclick'=>'$("#mydialog_withoutimages").dialog("open"); return false;',
                     ));?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Products without description');?>: <?php echo $productsWithoutDescription->totalItemCount ;?>
            <?php echo CHtml::link(Yii::t('common', 'See'), '#', array(
                        'onclick'=>'$("#mydialog_withoutdesc").dialog("open"); return false;',
                     ));?>
        </li>
        <li>
            <?php echo Yii::t('common', 'Products without short description');?>: <?php echo $productsWithoutShortDescription->totalItemCount ;?>
            <?php echo CHtml::link(Yii::t('common', 'See'), '#', array(
                        'onclick'=>'$("#mydialog_withoutshortdesc").dialog("open"); return false;',
                     ));?>
        </li>
    </ul>
    <hr>
    <h4><?php echo Yii::t('common', 'Descriptions statistic')?></h4>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productsDescriptionStat,
        'columns'=>array(
            'title_native',
            array(
                'name'=>  Yii::t('common', 'Products with description'),
                'value'=>'count($data->productTranslations)',
            ),
            array(
                'name'=>  Yii::t('common', 'Products without description'),
                'value'=>$totalProducts .' - count($data->productTranslations)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'buttons'=>array(
                    'view' => array
                    (
                        'label'=>Yii::t("common", "View products without description"),
                        'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/viewProductsWithoutDesc",$data)',
                    )
                ),
            ),
        ),
    ));
    
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productsShortDescriptionStat,
        'columns'=>array(
            'title_native',
            array(
                'name'=>  Yii::t('common', 'Products with short description'),
                'value'=>'count($data->productTranslations)',
            ),
            array(
                'name'=>  Yii::t('common', 'Products without short description'),
                'value'=>$totalProducts.' - count($data->productTranslations)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'buttons'=>array(
                    'view' => array
                    (
                        'label'=>Yii::t("common", "View products without short description"),
                        'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/viewProductsWithoutDesc",$data)',
                    )
                ),
            ),
        ),
    ));
    ?>
    <hr>
</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog_notassigned',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common', 'Not assigned images'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));
?>
<table>
    <tr>
        <th><?php echo Yii::t('common', 'Product Images')?></th>
    </tr>
    <?php if (count($notAssignedImages)>0):?>
    <?php foreach ($notAssignedImages as $img):?>
    <tr>
        <td>
            <?php echo CHtml::link($imagesPath.$img, Yii::app()->getBaseUrl().Yii::app()->params['shopImagesURL'].$img, array('class'=>'fancybox-image')) ?>
        </td>
    </tr>
    <?php endforeach;?>    
    <?php endif;?>
</table>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog_lostfiles',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common', 'Lost image files'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));
?>
<table>
    <tr>
        <th><?php echo Yii::t('common', 'Product Images')?></th>
    </tr>
    <?php if (count($lostFiles)>0):?>
    <?php foreach ($lostFiles as $img):?>
    <tr>
        <td>
            <?php echo CHtml::link($imagesPath.$img, Yii::app()->getBaseUrl().Yii::app()->params['shopImagesURL'].$img, array('class'=>'fancybox-image')) ?>
        </td>
    </tr>
    <?php endforeach;?>    
    <?php endif;?>
</table>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog_withoutimages',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common', 'Products without image'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productsWithoutImage,
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

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog_withoutdesc',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common', 'Products without description'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));

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

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog_withoutshortdesc',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common', 'Products without short description'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));

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

$this->endWidget('zii.widgets.jui.CJuiDialog');
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog_newly_created',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common', 'Newly Created'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$productsNewlyCreated,
        'columns'=>array(
            'id',
            'product_sku',
            'name',
            array(
                'name'=>Yii::t('common', 'Manufacturer'),
                'value'=>'$data->manufacturer_id?Manufacturers::listData($data->manufacturer_id):Yii::t("common","*no name*")',
            ),
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

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
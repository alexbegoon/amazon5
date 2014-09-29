<?php
/* @var $this LanguagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Languages'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Languages'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Languages'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Languages')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
        'columns'=>array(
            'lang_code',
            'title',
            'title_native',
            'sef',
            array(
                'name'=>'image_url',
                'type'=>'html',
                'value'=>'CHtml::image(Yii::app()->createUrl($data->image_url),$data->title)',
            ),
            array(
                'name'=>'image_url_thumb',
                'type'=>'html',
                'value'=>'CHtml::image(Yii::app()->createUrl($data->image_url_thumb),$data->title)',
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

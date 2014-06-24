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
                'value'=>'$data->published==1?"Yes":"No"',
            ),
            array(
                'name'=>'created_by',
                'value'=>'Yii::app()->getModule(\'user\')->user($data->created_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->created_by)->profile->getAttribute(\'lastname\')',
            ),
            'created_on',
            
            array(
                'name'=>'modified_by',
                'value'=>'Yii::app()->getModule(\'user\')->user($data->modified_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->modified_by)->profile->getAttribute(\'lastname\')',
            ),
            'modified_on',
            array(
                'name'=>'lock',
                'type'=>'html',
                'value'=>'$data->locked_by!=0?"<span class=\"glyphicon glyphicon-lock\" title=\"".Yii::t(\'common\',\'Locked By\')." ". Yii::app()->getModule(\'user\')->user($data->locked_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->locked_by)->profile->getAttribute(\'lastname\')."\"></span>":""',                
            ),
        ),
)); ?>

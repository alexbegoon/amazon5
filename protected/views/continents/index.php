<?php
/* @var $this ContinentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('common','Continents'),
);

$this->menu=array(
        array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Continents'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Continents'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common','Continents')?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
        'columns'=>array(
            'code',
            'name',
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
                'value'=>'$data->locked_by!=0?"<span class=\"glyphicon glyphicon-lock\" title=\"Locked by ". Yii::app()->getModule(\'user\')->user($data->locked_by)->profile->getAttribute(\'firstname\') ." ". Yii::app()->getModule(\'user\')->user($data->locked_by)->profile->getAttribute(\'lastname\')."\"></span>":""',                
            ),
        ),
)); ?>

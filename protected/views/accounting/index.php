<?php
/* @var $this AccountingController */

$this->breadcrumbs=array(
	Yii::t('common', 'Accounting'),
);
?>
<h1 class="text-center"><?php echo Yii::t('common', 'Accounting'); ?></h1>


<?php $this->widget('TilesWidget',array(
    
                'items' => array(
                    array(
                        'url'=>'providers',
                        'glyphicon'=>'glyphicon-briefcase',
                        'label'=>Yii::t('common','Provider Management'),
                        ),
                    array(
                        'url'=>'rights',
                        'glyphicon'=>'glyphicon-file',
                        'label'=>Yii::t('common','Invoice Management'),
                        ),
                    array(
                        'url'=>'rights',
                        'glyphicon'=>'glyphicon-calendar',
                        'label'=>Yii::t('common','Accounting Overview'),
                        ),
                ),
))?>
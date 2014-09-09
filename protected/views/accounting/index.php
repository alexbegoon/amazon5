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
                        'fa'=>'fa-truck',
                        'label'=>Yii::t('common','Provider Management'),
                        ),
                    array(
                        'url'=>'providerInvoices',
                        'glyphicon'=>'glyphicon-file',
                        'label'=>Yii::t('common','Invoice Management'),
                        ),
                    array(
                        'url'=>'accountingOverview',
                        'glyphicon'=>'glyphicon-calendar',
                        'label'=>Yii::t('common','Accounting Overview'),
                        ),
                    array(
                        'url'=>'servicesProviders',
                        'glyphicon'=>'glyphicon-briefcase',
                        'label'=>Yii::t('common','Providers of the Services'),
                        ),
                    array(
                        'url'=>'servicesProvidersTypes',
                        'fa'=>'fa-cog',
                        'label'=>Yii::t('common','Types of the service providers'),
                        ),
                ),
))?>
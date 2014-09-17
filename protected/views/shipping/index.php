<?php
/* @var $this ShippingController */

$this->breadcrumbs=array(
        Yii::t('common', 'Shipping'),
);
?>
<h1 class="text-center"><?php echo Yii::t('common', 'Shipping'); ?></h1>

<?php $this->widget('TilesWidget',array(
    
                'items' => array(
                    array(
                        'url'=>'shippingCompanies',
                        'fa'=>'fa-truck',
                        'label'=>Yii::t('common','Shipping Companies'),
                        ),
                    array(
                        'url'=>'shippingTypes',
                        'glyphicon'=>'glyphicon-time',
                        'label'=>Yii::t('common','Shipping Types'),
                        ),
                    array(
                        'url'=>'shippingMethods',
                        'fa'=>'fa-list-ul',
                        'label'=>Yii::t('common','Shipping Methods'),
                        ),
                    array(
                        'url'=>'postalCodesRanges',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>Yii::t('common','Ranges of the Postal Codes'),
                        ),
                ),
))?>
<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	Yii::t('common','Dashboard'),
);
?>
<h1 class="text-center"><?php echo Yii::t('common','Dashboard');?></h1>

<?php $this->widget('TilesWidget',array(
    
                'items' => array(
                    array(
                        'url'=>'user',
                        'glyphicon'=>'glyphicon-user',
                        'label'=>Yii::t('common','Users'),
                        ),
                    array(
                        'url'=>'rights',
                        'glyphicon'=>'glyphicon-eye-open',
                        'label'=>Yii::t('common','Rights'),
                        ),
                    array(
                        'url'=>'orders',
                        'glyphicon'=>'glyphicon-shopping-cart',
                        'label'=>Yii::t('common','Orders'),
                        ),
                    array(
                        'url'=>'languages',
                        'glyphicon'=>'glyphicon-flag',
                        'label'=>Yii::t('common','Languages'),
                        ),
                    array(
                        'url'=>'webShops',
                        'glyphicon'=>'glyphicon-home',
                        'label'=>Yii::t('common','Web Shops'),
                        ),
                    array(
                        'url'=>'currencies',
                        'glyphicon'=>'glyphicon-euro',
                        'label'=>Yii::t('common','Currencies'),
                        ),
                    array(
                        'url'=>'continents',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>Yii::t('common','Continents'),
                        ),
                    array(
                        'url'=>'countries',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>Yii::t('common','Countries'),
                        ),
                    array(
                        'url'=>'states',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>Yii::t('common','States'),
                        ),
                    array(
                        'url'=>'manufacturers',
                        'glyphicon'=>'glyphicon-list-alt',
                        'label'=>Yii::t('common','Manufacturers'),
                        ),
                    array(
                        'url'=>'accounting',
                        'glyphicon'=>'glyphicon-briefcase',
                        'label'=>Yii::t('common','Accounting'),
                        ),
                    array(
                        'url'=>'products',
                        'glyphicon'=>'glyphicon-barcode',
                        'label'=>Yii::t('common','Products'),
                        ),
                ),
))?>

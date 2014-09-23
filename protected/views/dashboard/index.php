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
                        'fa'=>'fa-users',
                        'label'=>Yii::t('common','Users'),
                        ),
                    array(
                        'url'=>'rights',
                        'fa'=>'fa-eye-slash',
                        'label'=>Yii::t('common','Rights'),
                        ),
                    array(
                        'url'=>'orders',
                        'fa'=>'fa-shopping-cart',
                        'label'=>Yii::t('common','Orders'),
                        ),
                    array(
                        'url'=>'languages',
                        'fa'=>'fa-bullhorn',
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
                        'glyphicon'=>'glyphicon-flag',
                        'label'=>Yii::t('common','Countries'),
                        ),
                    array(
                        'url'=>'states',
                        'glyphicon'=>'glyphicon-flag',
                        'label'=>Yii::t('common','States'),
                        ),
                    array(
                        'url'=>'manufacturers',
                        'glyphicon'=>'glyphicon-list-alt',
                        'label'=>Yii::t('common','Manufacturers'),
                        ),
                    array(
                        'url'=>'accounting',
                        'fa'=>'fa-briefcase',
                        'label'=>Yii::t('common','Accounting'),
                        ),
                    array(
                        'url'=>'products',
                        'glyphicon'=>'glyphicon-barcode',
                        'label'=>Yii::t('common','Products'),
                        ),
                    array(
                        'url'=>'categories',
                        'fa'=>'fa-sitemap',
                        'label'=>Yii::t('common','Categories'),
                        ),
                    array(
                        'url'=>'shipping',
                        'fa'=>'fa-truck',
                        'label'=>Yii::t('common','Shipping'),
                        ),
                    array(
                        'url'=>'payment',
                        'fa'=>'fa-cc-visa',
                        'label'=>Yii::t('common','Payment'),
                        ),
                    array(
                        'url'=>'synchronization',
                        'fa'=>'fa-refresh fa-spin',
                        'label'=>Yii::t('common','Synchronization'),
                        ),
                ),
))?>

<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1 class="text-center">Dashboard</h1>

<?php $this->widget('TilesWidget',array(
    
                'items' => array(
                    array(
                        'url'=>'user',
                        'glyphicon'=>'glyphicon-user',
                        'label'=>'Users',
                        ),
                    array(
                        'url'=>'rights',
                        'glyphicon'=>'glyphicon-eye-open',
                        'label'=>'Rights',
                        ),
                    array(
                        'url'=>'orders',
                        'glyphicon'=>'glyphicon-shopping-cart',
                        'label'=>'Orders',
                        ),
                    array(
                        'url'=>'languages',
                        'glyphicon'=>'glyphicon-flag',
                        'label'=>'Languages',
                        ),
                    array(
                        'url'=>'webShops',
                        'glyphicon'=>'glyphicon-home',
                        'label'=>'Web Shops',
                        ),
                    array(
                        'url'=>'currencies',
                        'glyphicon'=>'glyphicon-euro',
                        'label'=>'Currencies',
                        ),
                    array(
                        'url'=>'continents',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>'Continents',
                        ),
                    array(
                        'url'=>'countries',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>'Countries',
                        ),
                    array(
                        'url'=>'states',
                        'glyphicon'=>'glyphicon-globe',
                        'label'=>'States',
                        ),
                ),
))?>

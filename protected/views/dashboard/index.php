<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h3>Dashboard</h3>

<?php $this->widget('TIlesWidget',array(
    
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
                        'url'=>'webshops',
                        'glyphicon'=>'glyphicon-home',
                        'label'=>'Web Shops',
                        ),
                ),
))?>

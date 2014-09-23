<?php
/* @var $this PaymentController */

$this->breadcrumbs=array(
        Yii::t('common', 'Payment'),
);
?>
<h1 class="text-center"><?php echo Yii::t('common', 'Payment'); ?></h1>

<?php $this->widget('TilesWidget',array(
    
                'items' => array(
                    array(
                        'url'=>'paymentMethods',
                        'fa'=>'fa-list-ul',
                        'label'=>Yii::t('common','Payment Methods'),
                        ),
                ),
))?>
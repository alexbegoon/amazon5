<?php
/**
 * Description of currencybox
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
?>
<?php echo CHtml::form(); ?>
    <div id="currencydrop">
        <?php echo CHtml::dropDownList('currencyId', $currencyId, CHtml::listData(Currencies::model()->findAll(array('order'=>'currency_name','condition'=>'published = 1')),'id','currency_name'), array('submit' => '')); ?>
    </div>
<?php echo CHtml::endForm(); ?>
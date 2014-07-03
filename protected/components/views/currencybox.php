<?php
/**
 * Description of currencybox
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
?>
<?php echo CHtml::form(); ?>
    <div id="currencydrop">
        <?php echo CHtml::dropDownList('currencyId', $currencyId, Currencies::listData(), array('submit' => '')); ?>
    </div>
<?php echo CHtml::endForm(); ?>
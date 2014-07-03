<?php
/**
 * Description of langBox
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
?>
<?php echo CHtml::form(); ?>
    <div id="langdrop">
        <?php echo CHtml::dropDownList('lang', $currentLang, Languages::listData(), array('submit' => '')); ?>
    </div>
<?php echo CHtml::endForm(); ?>
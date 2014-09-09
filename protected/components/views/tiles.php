<?php
/**
 * Description of tiles
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
?>
<?php if($tiles != null): ?>
<div class="row">
    <?php foreach($tiles as $tile): ?>
            <?php $tile = (object)$tile?>
    <div class="col-md-3 col-sm-6 col-xs-6 col-lg-3">
    <?php if(isset($tile->glyphicon)&&!empty($tile->glyphicon)):
        $class = 'glyphicon '.$tile->glyphicon
        ?>
    <?php endif;?>
    <?php if(isset($tile->fa)&&!empty($tile->fa)):
        $class = 'fa '.$tile->fa
        ?>
    <?php endif;?>
    <?php echo CHtml::link("<h4 class=\"text-center\">$tile->label&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"$class\"></i></h4>",Yii::app()->createUrl($tile->url), array('class'=>'thumbnail'));?>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
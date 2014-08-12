<?php
/* @var $this SynchronizationController */

?>
<h1 class="text-center"><?php echo Yii::t('common',  ucfirst($this->id)); ?></h1>

<?php if(count($items)):?>
<ul>
    <?php foreach ($items as $item):?>
    <li><?php echo $item?></li>
    <?php endforeach;?>
</ul>
<?php endif;?>

<p>
    <?php echo Yii::t('common', 'Total execution time:')?> <?= round(Yii::getLogger()->getExecutionTime(),2)?> <?php echo Yii::t('common', 'seconds')?>.
</p>

<?php
/**
 * Description of batch_upload_images
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */

/* @var $this ProductsController */
/* @var $model ProductImages */

$this->breadcrumbs=array(
	Yii::t('common','Products')=>array('index'),
	Yii::t('common','Batch Upload Images'),
);

?>

<h1 class="text-center"><?php echo Yii::t('common', 'Batch Upload Images');?></h1>

<?php $this->renderPartial('_batch_images', array(  'model'=>$model)); ?>
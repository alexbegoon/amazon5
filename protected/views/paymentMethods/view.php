<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */

$this->breadcrumbs=array(
        Yii::t('common', 'Payment')=>array('payment/index'),
	Yii::t('common','Payment Methods')=>array('index'),
	$model->getName(),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Payment Methods'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Payment Method'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Payment Method'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Payment Methods'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Payment Method')?> '<?php echo $model->getName(); ?>'</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                    'name'=>  Yii::t('common', 'Published'),
                    'type'=>'html',
                    'value'=>$model->published==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Unpublish")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Publish"))),
                ),
		'handler_component',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->modified_by)->getFullName(),
                ),
	),
)); ?>

<hr>
<h3 class="text-center"><?php echo Yii::t('common', 'Payment Method Name')?></h3>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$paymentMethodTranslations,
	'columns'=>array(
                array(
                    'name'=>  Yii::t('common', 'Language'),
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('payment_method_id'=>$model->id))),
                ),
                'payment_method_name',
                'payment_method_title',
                'payment_method_desc',
		'created_on',
                array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->created_by)->getFullName()',
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> 'Yii::app()->getModule("user")->user($data->modified_by)->getFullName()',
                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>'Yii::app()->createUrl(Yii::app()->controller->id."/updateTranslation",$data->getPrimaryKey())',
                        )
                    ),
                )
	),
));
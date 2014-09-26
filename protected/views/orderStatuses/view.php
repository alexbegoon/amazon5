<?php
/* @var $this OrderStatusesController */
/* @var $model OrderStatuses */

$this->breadcrumbs=array(
	Yii::t('common','Order Statuses')=>array('index'),
	$model->getName(),
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Order Statuses'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Order Status'), 'url'=>array('create')),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Order Status'), 'url'=>'#', 'linkOptions'=>array('csrf'=>true,'submit'=>array('delete','id'=>$model->status_code),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Order Statuses'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Order Status')?> '<?php echo $model->getName(); ?>'</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'status_code',
		array(
                    'name'=>'published',
                    'type'=>'html',
                    'value'=>$model->published==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Unpublish")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("published"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Publish"))),
                ),
                array(
                    'name'=>'public',
                    'type'=>'html',
                    'value'=>$model->public==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("public"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Private")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("public"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Public"))),
                ),
                array(
                    'name'=>'notify_customer_if_applied',
                    'type'=>'html',
                    'value'=>$model->notify_customer_if_applied==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("notify_customer_if_applied"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Not notify")))               
                                                                  :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("notify_customer_if_applied"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Notify"))),
                ),
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
<h3 class="text-center"><?php echo Yii::t('common', 'Order Statuses Name');?></h3>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$orderStatusTranslations,
	'columns'=>array(
                array(
                    'name'=>'language_code',
                    'value'=>  'Languages::getNameByPk($data->language_code)',
                    'footer'=>  CHtml::link(Yii::t('common', 'Add'),Yii::app()->createUrl(Yii::app()->controller->id."/createTranslation",array('status_code'=>$model->status_code))),
                ),
                'status_name',
                'status_desc',
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

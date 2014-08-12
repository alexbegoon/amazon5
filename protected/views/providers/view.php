<?php
/* @var $this ProvidersController */
/* @var $model Providers */

$this->breadcrumbs=array(
    Yii::t('common','Accounting')=>array('/accounting'),
	Yii::t('common','Providers')=>array('index'),
	$model->provider_name,
);

$this->menu=array(
	array('label'=>Yii::t('common','List') .' '. Yii::t('common','Providers'), 'url'=>array('index')),
	array('label'=>Yii::t('common','Create') .' '. Yii::t('common','Provider'), 'url'=>array('create')),
        array('label'=>Yii::t('common','Update') .' '. Yii::t('common','Provider'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('common','Delete') .' '. Yii::t('common','Provider'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('common','Manage') .' '. Yii::t('common','Providers'), 'url'=>array('admin')),
);
?>

<h1 class="text-center"><?php echo Yii::t('common', 'View')?> <?php echo Yii::t('common', 'Provider')?> "<?php echo $model->provider_name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'provider_name',
		'cif',
                'provider_type',
		'provider_desc',
		'provider_url',
		'provider_country',
		'provider_address',
                'provider_phone',
                'provider_fax',
                array(
                    'name'=>'sku_as_ean',
                    'type'=>'html',
                    'value'=>$model->sku_as_ean==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("sku_as_ean"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "No")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("sku_as_ean"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "Yes"))),
                ),
                'sku_format',
                'discount',
		'vat',
                array(
                    'name'=>'inactive',
                    'type'=>'html',
                    'value'=>$model->inactive==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("inactive"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Activate")))               
                                                :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("inactive"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("common", "Deactivate"))),
                ),
                array(
                    'name'=>'currency_id',
                    'value'=> Currencies::listData($model->currency_id),
                ),
                array(
                    'name'=>'default_language',
                    'value'=> Languages::listData($model->default_language),
                ),
		'provider_email',
		'provider_email_copy_1',
		'provider_email_copy_2',
		'provider_email_hidden_copy',
		'provider_email_hidden_copy_2',
		'email_subject',
		'email_body',
                'service_url',
                array(
                    'name'=>'sync_enabled',
                    'value'=>$model->sync_enabled==1?Yii::t('common','Yes'):Yii::t('common','No'),
                ),
                array(
                    'name'=>'sync_enabled',
                    'type'=>'html',
                    'value'=>$model->sync_enabled==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("sync_enabled"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "No")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("sync_enabled"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "Yes"))),
                ),
                'sync_schedule',
                'last_sync_date',
                array(
                    'name'=>'send_csv',
                    'type'=>'html',
                    'value'=>$model->send_csv==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("send_csv"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "No")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("send_csv"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "Yes"))),
                ),
                'csv_format',
                array(
                    'name'=>'send_xls',
                    'type'=>'html',
                    'value'=>$model->send_xls==1?Yii::t("yii", "Yes").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-ban red"></i>', Yii::app()->controller->createUrl("toggle",array("send_xls"=>0,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "No")))               
                                                 :Yii::t("yii", "No").'&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::link('<i class="fa fa-check green"></i>', Yii::app()->controller->createUrl("toggle",array("send_xls"=>1,"id"=>$model->primaryKey)),array('title'=>Yii::t("yii", "Yes"))),
                ),
                'xls_format',
		'created_on',
		array(
                    'name'=>  Yii::t('common', 'Created By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
		'modified_on',
		array(
                    'name'=>  Yii::t('common', 'Modified By'),
                    'value'=> Yii::app()->getModule("user")->user($model->created_by)->getFullName(),
                ),
//		'locked_on',
//		'locked_by',
	),
)); ?>

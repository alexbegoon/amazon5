<?php
/* @var $this AccountingOverviewController */

$this->breadcrumbs=array(
        Yii::t('common', 'Accounting')=>array('/accounting'),
	Yii::t('common', 'Accounting Overview'),
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php
 
// Date range search inputs
$attribute = 'created_on';
$from_id = CHtml::activeId($model, $attribute.'_0');
$to_id = CHtml::activeId($model, $attribute.'_1');

for ($i = 0; $i <= 1; $i++)
{
    if($i==0)
    {
        $onClose='js:function( selectedDate ) {$( "#'.$to_id.'" ).datepicker( "option", "minDate", selectedDate )}';
    }
    else 
    {
        $onClose='js:function( selectedDate ) {$( "#'.$from_id.'" ).datepicker( "option", "maxDate", selectedDate )}';
    }
    echo ($i == 0 ? Yii::t('common', 'From:') : Yii::t('common', 'To:'));
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'id'=>CHtml::activeId($model, $attribute.'_'.$i),
        'model'=>$model,
        'language'=>Yii::app()->language,
        'attribute'=>$attribute."[$i]",
        'options'=>array(
            'dateFormat'=>'yy-mm-dd',
            'changeMonth' => 'true',
            'changeYear'=>'true',
            'onClose'=>$onClose,
        ),
    )); 
    echo "&nbsp;&nbsp;&nbsp;";
}
?>

<?php echo CHtml::submitButton(Yii::t('common','Search'),array('class'=>'btn btn-primary')); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'columns'=>array(
        'id',
        array(
            'name'=>  Yii::t('common', 'Provider Name'),
            'value'=>  'Providers::model()->findByPk($data->provider_id)->provider_name',
        ),
        array(
            'name'=>  Yii::t('common', 'Total Cost'),
            'value'=> 'Currencies::priceDisplay($data->totalCost, $data->currency_id)',
            'footer'=> Yii::t('common', 'Total: '). Currencies::priceDisplay($model->getTotal('totalCost',$model->search()->getKeys()), Currencies::getCurrencyForDisplay()),
        ),
        array(
            'name'=>  Yii::t('common', 'VAT'),
            'value'=> 'Providers::model()->findByPk($data->provider_id)->vat',
        ),
        array(
            'name'=>  Yii::t('common', 'Paid'),
            'value'=> '$data->paid==1?Yii::t("yii", "Yes"):Yii::t("yii", "No")',
        ),
        array(
            'name'=>  Yii::t('common', 'Created On'),
            'value'=>'$data->created_on',
            'filter'=>false, // Set the filter to false when date range searching
        ),
    ),
)); 
?>

<?php $this->endWidget(); ?>
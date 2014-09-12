<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/signin.css');
?>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<!--<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>-->

<div class="container">
    
<?php echo CHtml::beginForm(null, 'POST', array('class'=>'form-signin', 'role'=>'form')); ?>

	<!--<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>-->
	<h2 class="form-signin-heading text-center"><?php echo UserModule::t("Login"); ?></h2>
	<?php echo CHtml::errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>
	
	<div class="row form-group">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username',array('class'=>'form-control','required'=>"", 'autofocus'=>"")) ?>
	</div>
	
	<div class="row form-group">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password',array('class'=>'form-control','required'=>"")) ?>
	</div>
	
	<div class="row form-group">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Login"), array('class'=>'btn btn-lg btn-primary btn-block')); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
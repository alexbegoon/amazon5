<?php /* @var $this Controller */ ?>
<?php 
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
        
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">
        
        <!-- Bootstrap framework -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.2.0/css/bootstrap-select.min.css">
        <!-- End Bootstrap framework -->
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-4.1.0/css/font-awesome.min.css">
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        </div>
        <div class="navbar-collapse collapse">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav navbar-right'),
                'items' => array(
                    array('label' => Yii::t('common','Dashboard'), 'url' => array('/dashboard/index'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => Yii::t('common','Language'), 'url'=>array('#'), 'linkOptions'=>array('onclick'=>'$("#langWindow").dialog("open"); return false;')),
                    array('label' => Yii::t('common','Currency'), 'url'=>array('#'), 'linkOptions'=>array('onclick'=>'$("#currencyWindow").dialog("open"); return false;')),
                    array('label' => Yii::t('common', 'Login'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => Yii::t('common', 'Logout') . ' (' . Yii::app()->user->name . ')', 'url' => array('/user/logout','token'=>Yii::app()->getRequest()->getCsrfToken()), 'visible' => !Yii::app()->user->isGuest),
                    
                ),
            ));
            ?>
<!--            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>-->
        </div>
    </div>
</nav>
<div class="container-fluid">
        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'htmlOptions' => array('class' => 'breadcrumb'),
                'links' => $this->breadcrumbs,
                'tagName'=>'ol', // will change the container to ul
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                'separator' => '',
                
            ));
            ?><!-- breadcrumbs -->
        <?php endif; ?>
        <?php $i=1;?>
        <?php foreach(Yii::app()->user->getFlashes() as $key => $message):?>
            <div class="alert alert-<?php echo strtolower($key);?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo Yii::t('common', 'Close');?></span></button>
                <strong><?php echo Yii::t('Common', ucwords(strtolower($key)))?>!</strong><span id="flash-message-<?php echo $i;?>">&nbsp;<?php echo Yii::t('common', $message);?></span>
            </div>
        <?php $i++;?>
        <?php endforeach;?>
        <div id='Ajax-flash-message-success' class="alert alert-success alert-dismissible" style="display:none"></div>
        <div id='Ajax-flash-message-error' class="alert alert-danger alert-dismissible" style="display:none"></div>

        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer">
        </div><!-- footer -->
</div>
<div style="display: none;">
<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'langWindow',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common','Language'),
        'autoOpen'=>false,
        'width'=>'auto',
        'height'=>'auto',
        'modal'=>'true'
    ),
));
    echo Yii::t('common','Select language');
    $this->widget( 'LangBox'
                        );

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'currencyWindow',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>Yii::t('common','Currency'),
        'autoOpen'=>false,
        'width'=>'auto',
        'height'=>'auto',
        'modal'=>'true'
    ),
));
    echo Yii::t('common','Select Currency');
    $this->widget( 'CurrencyBox'
                        );

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
</div>

<!-- JQuery -->
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>-->
<!-- End JQuery -->

<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Bootstrap framework -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.2.0/js/bootstrap-select.min.js"></script>
<!-- End Bootstrap framework -->

</body>
</html>

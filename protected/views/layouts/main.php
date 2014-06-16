<?php /* @var $this Controller */ ?>
<?php 
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
        
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/imgs/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/imgs/favicon.ico" type="image/x-icon">
        
        <!-- Bootstrap framework -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.1.1/css/bootstrap-select.min.css">
        <!-- End Bootstrap framework -->
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        
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
                    array('label' => 'Dashboard', 'url' => array('/dashboard/index'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Users', 'url' => array('/user'), 'visible' => !Yii::app()->user->isGuest), 
                    array('label' => Yii::t('app', 'Login'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => Yii::t('app', 'Rights'), 'url' => array('/rights'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => Yii::t('app', 'Logout') . ' (' . Yii::app()->user->name . ')', 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest)
                ,
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
        <?php endif ?>

        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer">
        </div><!-- footer -->
</div>

<!-- JQuery -->
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>-->
<!-- End JQuery -->

<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Bootstrap framework -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/3.1.1/js/bootstrap-select.min.js"></script>
<!-- End Bootstrap framework -->

</body>
</html>

<?php
/* @var $this AjaxController */

$this->breadcrumbs=array(
	'AJAX Request',
);
?>

<h2 class="text-center">Dump POST request.</h2>

<code>$_POST</code>
<br>
<?php 
CVarDumper::dump($_POST,10,true);
?>
<br>
<br>
<code>$_GET</code>
<br>
<?php 
CVarDumper::dump($_GET,10,true);
?>


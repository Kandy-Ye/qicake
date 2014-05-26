<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
	if(isset($meta_keywords)) echo $html->meta('keywords', $meta_keywords);
	if(isset($meta_description)) echo $html->meta('description', $meta_description);
?>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="<?php echo $html->webroot ?>favicon.ico" />
<?php 
	echo $this->element('css');
	// echo $this->element('css', array('css' => array('bootstrap')));
	// echo $this->element('google_analytics', array('user' => $currentUser));
?>
</head>

<body id="nv_<?php echo $this->params["controller"]?>">

<div class='control'>
	<?php 
		echo $form->hidden('webroot', array('default' => $this->webroot));
		echo $form->hidden('controller', array('default' => $this->params["controller"]));
		echo $form->hidden('action', array('default' => $this->params["action"])) 
	?>
</div>

<?php echo $this->element('header') ?>
 
<?php echo $content_for_layout; ?>

<?php echo $this->element('footer'); ?>

<?php 
	echo $this->element('sql_dump');
	if(isset($js)) echo $this->element('js', array('scripts_for_layout' => $scripts_for_layout));
?>
</body>
</html>

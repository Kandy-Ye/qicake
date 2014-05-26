<?php 
	// common javascript
	echo $html->script(JQUERY);
	// echo $html->script(BOOTSTRAP);
	// echo $html->script(COMMON);
	// echo $html->script(JSON2);

	if (isset($scripts_for_layout)) {
		echo $scripts_for_layout;
	}

	$base_dir = APP.WEBROOT_DIR.DS."js".DS.$this->params["controller"];
	// controller specified javascript
	if (is_file($base_dir.DS.$this->params["controller"].".js")){ 
       	echo $html->script($this->params["controller"]."/".$this->params["controller"]);
	}
	// action specified javascript
	if (is_file($base_dir.DS.$this->params["action"].".js")){ 
       	echo $html->script($this->params["controller"]."/".$this->params["action"]);
	}

	// javascript dump util
	if (Configure::read() >= 1) {
		// echo $html->script('dump');
	}

	echo $js->writeBuffer();
?>

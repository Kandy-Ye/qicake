<?php 
	// Home
  Router::connect('/', array('controller' => 'portals', 'action' => 'index'));

	// Static - no databases
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>

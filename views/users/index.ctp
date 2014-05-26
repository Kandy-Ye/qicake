<?php 
	$html->script('utils/mustache', array('inline' => false));
  $html->script('jquery/jquery.waterfall.min', array('inline' => false));
?>

<div id="header">
<h1>use mustache template</h1>
</div>
<div id="container"></div>
<script type="text/template" id="waterfall-tpl">
{{#result}}
<div class="item">
    <img src="{{image}}" width="{{width}}" height="{{height}}" />
</div>
{{/result}}
</script>

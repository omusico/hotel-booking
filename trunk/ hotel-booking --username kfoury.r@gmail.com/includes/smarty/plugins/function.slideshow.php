<?php
/*
 * Smarty plugin
 */
function smarty_function_slideshow($params, &$smarty)
{
	return Slideshow::TemplateProvider($params,$smarty);
}

?>
<?php
/*
 * Smarty plugin
 */
function smarty_function_photos($params, &$smarty)
{
	return Photos::TemplateProvider($params,$smarty);
}

?>
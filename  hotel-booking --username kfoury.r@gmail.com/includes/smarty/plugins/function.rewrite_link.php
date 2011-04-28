<?php
function smarty_function_rewrite_link($params, &$smarty)
{
	global $_ZEDNET;
    if (isset($_ZEDNET['cache']['overrideIssue'])) return '/numero/'.$_ZEDNET['cache']['overrideIssue'] . $params['url'];
    else return $params['url'];
}

?>
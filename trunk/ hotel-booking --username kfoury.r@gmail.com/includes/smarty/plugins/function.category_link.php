<?php
function smarty_function_category_link($params, &$smarty)
{
	global $_ZEDNET;
    if ($_ZEDNET['site']['mod_rewrite'] === true) {
    	$title = str_replace(Array("'",' '),Array('','_'),$params['name']);
    	if (isset($_ZEDNET['cache']['overrideIssue'])) $prefix = '/numero/'.$_ZEDNET['cache']['overrideIssue'];
    	else $prefix = '';
    	return $prefix.'/category/'.$params['id'].'/'.urlencode($title.'-liban').'.html';
    } else {
    	return '/news/category.php?id=' . $params['id'];
    }
}

?>
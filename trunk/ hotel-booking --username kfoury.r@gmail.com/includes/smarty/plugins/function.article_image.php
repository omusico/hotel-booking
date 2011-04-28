<?php
function smarty_function_article_image($params, &$smarty)
{
	global $_ZEDNET;
	
	if ($params['article']['pdf'] != '') {
		$age = 0;
		if (Archives::checkAccess($params['article']['articleid'],false,$age) === false) {
			if ($age > 6) return('/archives/overview.php?id='.$params['article']['articleid']);
			else return('/account/purchase.php');
		}
		
		return $params['article']['pdf'];
	} else {
//		print_r($params);
	    //if ($_ZEDNET['site']['mod_rewrite'] === true) {
	    	$title = str_replace(Array("'",' ',"\r","\n",'/','�'),Array('','_','','','','_'),$params['article']['articletitle']);
			$title = urlencode(iconv('utf-8','ASCII//TRANSLIT',$title));
	    	if (isset($_ZEDNET['cache']['overrideIssue'])) return '/numero/'.$_ZEDNET['cache']['overrideIssue'] . '/article/'.$params['article']['articleid'].'/'.$title.'.html';
	    	return '/category/'.str_replace(' ','',urlencode($params['article']['categoryname'])).'/article/'.$params['article']['articleid'].'/'.$title.'.html';
	    //} else {
	    //	return '/news/article.php?id=' . $params['article']['articleid'];
	    //}
	}
}

?>
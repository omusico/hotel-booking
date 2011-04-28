<?php
function smarty_function_article_link($params, &$smarty)
{
	global $_ZEDNET;
	
	$title = str_replace(Array("'",' ',"\r","\n",'/','�'),Array('','_','','','','_'),$params['title']);
	$title = urlencode(iconv('utf-8','ASCII//TRANSLIT',$title));
	if (isset($params['ref'])) $ref = '/'.$params['ref'].'/';
	else $ref = '/';
	if ($title == '') $title = 'index';
	
	if (isset($params['highlight'])) {
		$highlight = 'highlight/'.urlencode($params['highlight']).'/';
	} else {
		$highlight = '';
	}
	return '/article/'.intval($params['id']).$ref.$highlight.$title.'.html';

}

?>
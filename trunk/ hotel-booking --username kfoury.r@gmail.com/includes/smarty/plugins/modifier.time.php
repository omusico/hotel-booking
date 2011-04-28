<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty escape modifier plugin
 *
 * Type:     modifier<br>
 * Name:     time<br>
 * Purpose:  Displays time in format hh:ii from seconds
 * @param int
 * @return string
 */
function smarty_modifier_time($str)
{
	// Max supported: hours
	$str = intval($str);
	$ret = '';
	if ($str >= 3600) {
		$hrs = floor($str/3600);
		$ret .= $hrs.':';
		$str = $str%3600;
	}
	$mins = floor($str/60);
	if ($mins < 10) $mins = '0'.$mins;
	$ret .= $mins .':';
	$str = $str%60;
	
	if ($str < 10) $str .= '0'.$str;
	$ret .= $str;
	
	return $ret;	
}

/* vim: set expandtab: */

?>

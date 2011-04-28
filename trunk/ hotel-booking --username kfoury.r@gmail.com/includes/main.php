<?php
// Boot up
session_start();
error_reporting(E_ALL | E_WARNING | E_ERROR);

$_ZEDNET = array(); // construct ZED NET
$_ZEDNET['live']['sessionid'] = session_id();
$_ZEDNET['live']['time'] = time();

require_once("config.php");
if (!defined('CONTENT_TYPE')) {
	header('Content-Type: text/html; charset=UTF-8');
    header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
    header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
    header( "Cache-Control: no-cache, must-revalidate" );
    header( "Pragma: no-cache" );
}

mb_internal_encoding("UTF-8");

require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/error.php');
require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/templates.php');
require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/upload.php');
require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/mail.php');
require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/db.php');
require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/admin.php');
require_once($_ZEDNET['site']['MAIN_PATH'] . 'includes/entry.php');

// Load classes when needed only
function __autoload($class_name) {
    if (!@include_once(MAIN_PATH.'includes/objects/'.strtolower($class_name).'.php')) {
    	zne_error('An error occurred and the web site may not continue. Please contact us immediately.<br /><br />ERROR: CL_INC ' . $class_name);
    }
}

function gotoPage($url) {
	header('Location: ' . $url);
	exit;
}

function leavepage() {
	global $_ZEDNET;
	gotoPage('/'.$_ZEDNET['language'].'/');
}

function XSSClean($str) {
	$str = str_replace('onclick','',$str);
	$str = str_replace('onmouseover','',$str);
	$str = str_replace('onhover','',$str);
	$str = str_replace('onmouseout','',$str);
	$str = str_replace('onblur','',$str);
	$str = str_replace('<script','',$str);
	$str = str_replace('javascript:','',$str);
	$str = preg_replace('/(\<!--\[if.+)(\<!--\[endif\]--\>)/i', '', $str);
	return $str;
}

if (isset($_ZEDNET['locale'])) {
	setlocale(LC_ALL, $_ZEDNET['locale']);
	setlocale(LC_TIME, $_ZEDNET['locale']);
}

?>
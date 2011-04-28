<?php
if (!defined('IN_ZEDNET')) exit;

if ($_ZEDNET['db']['status'] == 1) {
	// Call ADOdb
	require_once($_ZEDNET['site']['MAIN_PATH'] . "includes/adodb/adodb.inc.php");
	$ADODB_CACHE_DIR = CACHE_DIR;
	// Connect to database
	$zdb = ADONewConnection($_ZEDNET['db']['dbtype']);
	$zdb->debug = $_ZEDNET['db']['debug'];
	$zdb->charPage = 65001;
	
	if ($_ZEDNET['db']['dbtype'] != 'ado_mssql') {
		$conn = $zdb->Connect($_ZEDNET['db']['server'],
					 $_ZEDNET['db']['username'],$_ZEDNET['db']['password'], $_ZEDNET['db']['dbname']);
					 
	} else {
		$conn = $zdb->Connect($_ZEDNET['db']['dsn'], $_ZEDNET['db']['username'],$_ZEDNET['db']['password']);
	}
	if ($conn != true) zne_error($_ZEDNET['site']['sitename'] . ' was unable to continue because the database server is currently unavailable. '.$zdb->ErrorMsg());

	//$zdb->Execute("SET NAMES 'utf8'");
	$zdb->Execute("SET CHARACTER SET 'utf8'");
	$zdb->cacheSecs = $_ZEDNET['db']['cachetime'];
	$zdb->SetFetchMode(ADODB_FETCH_BOTH);
	$_ZEDNET['db'] = Array(); // clear database password - extra security
} else {
	$zdb = false;
}


function tablename($tbl) {
	if (defined('TABLE_PREFIX')) return TABLE_PREFIX.'_'.$tbl;
	else return $tbl;
}

?>
<?php
// Default paths
$debug = false;
$_ZEDNET['site']['sitename'] = "Hotel Booking";
$_ZEDNET['site']['MAIN_PATH'] = "/Users/Wadi/Sites/fyp/";
define('MAIN_PATH',$_ZEDNET['site']['MAIN_PATH']);
define('CACHE_DIR',MAIN_PATH."cache/");
define('TEMP_DIR',MAIN_PATH."temp/");
define('FILE_DIR',MAIN_PATH."files/");
define('LOG_FILE',MAIN_PATH."logfile");
$_ZEDNET['site']['domain'] = 'http://fyp.local/';
$_ZEDNET['path'] = $_ZEDNET['site']['MAIN_PATH'];

// Emails
$_ZEDNET['site']['emailfrom'] = 'noreply@fyp.local';
$_ZEDNET['site']['emailname'] = 'Hotel Booking';
$_ZEDNET['contact']['name'] = 'Rudy Zeinoun';
$_ZEDNET['contact']['email'] = 'rudy@reelagency.com';

// Site database information
$_ZEDNET['db']['status'] = 1;
$_ZEDNET['db']['dbtype'] = 'mysql';
$_ZEDNET['db']['server'] = '127.0.0.1';
$_ZEDNET['db']['username'] = 'root';
$_ZEDNET['db']['password'] = '';
$_ZEDNET['db']['dbname'] = 'fyp';
$_ZEDNET['db']['debug'] = $debug;
$_ZEDNET['db']['cachetime'] = 0;

// Template class
$_ZEDNET['smarty']['caching'] = false;
$_ZEDNET['smarty']['compile_check'] = true;
$_ZEDNET['smarty']['debugging'] = $debug;

$_ZEDNET['language'] = 'english';

define('IN_ZEDNET',true);
date_default_timezone_set('Asia/Beirut');
?>
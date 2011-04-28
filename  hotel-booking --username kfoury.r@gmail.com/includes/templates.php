<?php
if (!defined('IN_ZEDNET')) exit;

// load Smarty library
require('smarty/Smarty.class.php');

class UI extends Smarty {

	function UI()
	{
		global $_ZEDNET;
		// Class Constructor. These automatically get set with each new instance.

		$this->Smarty();

		$this->template_dir = $_ZEDNET['site']['MAIN_PATH'] . "interface/".$_ZEDNET['language']."/";
		$this->config_dir = $_ZEDNET['site']['MAIN_PATH'] . "interface/".$_ZEDNET['language']."/configs/";
		$this->compile_dir = $_ZEDNET['site']['MAIN_PATH'] . "interface/".$_ZEDNET['language']."/templates_c/";
		$this->cache_dir = $_ZEDNET['site']['MAIN_PATH'] . "interface/".$_ZEDNET['language']."/cache/";
		$this->trusted_dir = $_ZEDNET['site']['MAIN_PATH'];

		$this->caching = $_ZEDNET['smarty']['caching'];
		$this->compile_check = $_ZEDNET['smarty']['compile_check'];
		$this->debugging = $_ZEDNET['smarty']['debugging'];
		$this->assign_by_ref('_ZEDNET',$_ZEDNET);
		$this->assign_by_ref('_SESSION',$_SESSION);
		$this->assign_by_ref('_REQUEST',$_REQUEST);
		$this->assign_by_ref('_SERVER',$_SERVER);
		$this->assign('language',$_ZEDNET['language']);
		$this->assign('sitename',$_ZEDNET['site']['sitename']);
		$this->assign('rand',rand().rand());
	}
	
	
function display($tpl, $isIndex=false) {
		global $admin;

		if ($admin->checkPage() === true && !defined('PUBLIC')) $this->adminheader();
		else {
			$this->header($isIndex);
		}
		parent::display($tpl);
		
		if ($admin->checkPage() === true && !defined('PUBLIC')) $this->adminfooter();
		else {
			$this->footer($isIndex);
		}
	}

	
	function display_only($tpl) {
		parent::display($tpl);
	}
	
	function header($isIndex=false) {
		if (isset($_REQUEST['ajax'])) return;
		parent::display('header.html');
	}
	
	function footer($isIndex=false) {
		if (isset($_REQUEST['ajax'])) return;
		parent::display('footer.html');
	}

	/**
	 * Display the common footer template
	 *
	 */
	function adminheader() {
		parent::display('admin/header.html');
	}
	
	/**
	 * Display the common footer template
	 *
	 */
	function adminfooter() {
		parent::display('admin/footer.html');
	}
	
	/**
	 * Displays end of runtime information
	 */
	function printEndnotes() {
		global $_ZEDNET;
		echo '<!-- Page generated in ' . (microtime(true) - $_ZEDNET['live']['time']) . ' seconds at ' . $_SERVER['SERVER_NAME'] . ' -->';
	}

}
?>
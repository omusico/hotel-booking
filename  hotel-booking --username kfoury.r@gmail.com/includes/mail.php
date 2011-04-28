<?php

require("phpmailer/class.phpmailer.php");
require($_ZEDNET['site']['MAIN_PATH'] . 'includes/phpmailer/language/phpmailer.lang-en.php');

$_ZEDNET['PHPMAILER_LANG'] = $PHPMAILER_LANG;

class Email extends PHPMailer {

	function Email() {
		global $_ZEDNET;
		$this->From     = $_ZEDNET['site']['emailfrom'];
		$this->FromName = $_ZEDNET['site']['emailname'];
		$this->language = $_ZEDNET['PHPMAILER_LANG'];
		$this->IsSMTP();
		$this->CharSet = 'utf-8';
	}

}
?>
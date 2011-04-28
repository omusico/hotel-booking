<?php

class admin {

	function admin() {
		// Upon class loading, check if user is logged in via a cookie
		global $zdb;
		
		if (isset($_COOKIE['admin'])) {
			$cookie = unserialize(stripslashes($_COOKIE['admin']));
			if (!isset($cookie['username']) || !isset($cookie['password'])) {
				$this->loggedin = false;
			} else {
				$valid = $this->validate($cookie['username'],$cookie['password']);
				if ($valid === true) { $this->loggedin = true; }
				else { $this->loggedin = false; }
				
				$quser = $zdb->qstr($cookie['username']);
				$query = $zdb->Execute("SELECT `userid` FROM `admins` WHERE `username` = $quser");
				$this->username = $cookie['username'];
				$this->password = $cookie['password'];
				$this->userid = $query->fields[0];
			}
		} else {
			$this->loggedin = false;
		}
	}
	
	function validate($user,$pass) {
		global $zdb;
		
		// Pass is already md5-ed
		$quser = $zdb->qstr($user);
		$q = $zdb->Execute("SELECT `password` FROM `admins` WHERE `username` = $quser AND `active` = '1'");
		if ($q->RecordCount() != 1) return false;
		if ($q->fields[0] === $pass) return true;
		return false;
	}
	
	function login($username,$password) {
		if (strlen($username) < 3 || strlen($password) < 3) return false;
		$valid = $this->validate($username,md5($password));
		if ($valid === true) $this->cook($username,$password);
		else return false;
		return true;
	}
	
	function changepass($username,$password,$newpass) {
		global $zdb;
		$valid = $this->validate($username,md5($password));
		if ($valid === false) return 'The password you entered is incorrect.';
		else {
			if (strlen($newpass) < 3) return 'Your password is too short.';
			$pass = md5($newpass);
			$_SESSION['admin']['password'] = $pass;
			$q = $zdb->Execute("UPDATE `admins` SET `password` = '$pass' WHERE `username` = '$username'");
			if (!$q) return 'Unable to change your password. Try again later.';
			else return true;
		}
	}
	
	function cook($username,$password) {
		global $zdb;
		
		$cookie = Array();
		
		$cookie['username'] = $username;
		$cookie['password'] = md5($password);
		
		// Get ID
		$un = $zdb->qstr($username);
		$query = $zdb->Execute("SELECT `userid`,`super` FROM `admins` WHERE `username` = $un");
		$cookie['userid'] = $query->fields[0];
		$cookie['super'] = $query->fields[1];
		//$_SESSION['admin'] = $cookie;
		setcookie('admin',serialize($cookie),time()+43200,'/');
		
		return true;
	}
	
	function logout() {
		setcookie('admin','',time()-99999,'/');
		return true;
	}
	
	function checkPage() {
	
		$dir = dirname($_SERVER['SCRIPT_NAME']);
		if (preg_match('/\\/admin/',$dir) > 0) {
			return true;
		} else {
			return false;
		}

	}
	
	function isSuper() {
		if ($_SESSION['admin']['super'] == '1') return true;
		else return false;
	}
	
	function ListAdmins() {
		global $zdb;
		$sql = "SELECT `userid`,`username`,`active`,`super` FROM `admins` ORDER BY `username` ASC";
		$query = $zdb->Execute($sql);
		if (!$query || $query->RecordCount() < 1) return false;
		return $query->GetRows();	
	}
	

}

$admin = new admin;
if ($admin->checkPage() === true && $admin->loggedin === false && !defined('PUBLIC')) {
	// not allowed, redirect to admin login
	header('Location: '.$_ZEDNET['site']['domain'].'admin/login.php');
	exit;
}

?>
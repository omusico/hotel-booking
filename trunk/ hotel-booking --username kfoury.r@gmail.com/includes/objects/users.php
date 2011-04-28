<?php
class Users {
	
	public static function convertIPtoBinary($ip,$mask='') {
		$str = '';
		$sp = explode('.',$ip);
		for($i=0;$i<4;$i++) {
			$bin = decbin($sp[$i]);
			$str .= substr("00000000",0,8 - strlen($bin)) . $bin;
		}
		if ($mask == '') {
			$bin = bindec($str);
		} else {
			$str = substr($str,0,$mask).substr("00000000000000000000000000000000",0,32 - $mask);
			$bin = bindec($str);
		}
		return $bin;
	}
	
	public static function convertIPtoDecimal($ip) {
		return self::convertIPtoBinary($ip);
	}
	
	public static function convertBinaryToIP($bin) {
		$ip = decbin($bin);
		$ip = substr("00000000000000000000000000000000",0,32 - strlen($ip)) . $ip;
		$split = Array();
		$split[0] = substr($ip,0,8);
		$split[1] = substr($ip,8,8);
		$split[2] = substr($ip,16,8);
		$split[3] = substr($ip,24,8);
		$ip = bindec($split[0]).'.'.bindec($split[1]).'.'.bindec($split[2]).'.'.bindec($split[3]);		
		return $ip;
	}
		
	public static function loggedIn() {
		if (isset($_SESSION['user']) && $_SESSION['user']['loggedin'] === true) return true;
		else return false;
	}
	
	public static function loggedInManual() {
		if (self::loggedIn() === true && $_SESSION['user']['directLogin'] === false) return true;
		else return false;
	}
	
	public static function attr($k) {
		if (isset($_SESSION['user'][$k])) return $_SESSION['user'][$k];
		else return false;
	}
	
	public static function getUserId() {
		if (Users::loggedIn()) return $_SESSION['user']['userid'];
		else return 0;
	}
	
	static public function Login($username,$password,$remember=false) {
		if (strlen($password) < 3) return 'ShortPass';
		if (self::Exists($username,$password) === false) return 'BadPass';
		// Credentials are valid
		$info = self::GetDetails($username);
		if ($info === false) return false;
		$_SESSION['user'] = $info;
		$_SESSION['user']['loggedin'] = true;
		$_SESSION['user']['directLogin'] = false;
		self::recordLogin($username);
		if ($remember === true) {
			self::setCookie($username,$password);
		}
		return true;
	}
	
	static private function directLogin($userid) {
		$info = self::GetDetailsById($userid);
		if ($info === false) return false;
		$_SESSION['user'] = $info;
		$_SESSION['user']['loggedin'] = true;
		$_SESSION['user']['directLogin'] = true;
		self::recordLogin($info['username']);
		return true;
	}
	
	static public function Exists($username,$pass=false) {
		global $zdb;
		$username = $zdb->qstr($username);
		if ($pass === false) {
			$q = $zdb->Execute("SELECT COUNT(*) AS usercount FROM ".tablename('users')." WHERE username = $username");
			if ($q && $q->RecordCount() == 1 && $q->fields['usercount'] == '1') return true;
		} else {
			$mdpass = md5($pass);
			$q = $zdb->Execute("SELECT active FROM ".tablename('users')." WHERE username = $username AND password = '$mdpass'");
			if ($q && $q->RecordCount() == 1 && $q->fields['active'] == '1') return true;
		}
		return false;
	}
	
	static public function GetDetails($username) {
		global $zdb;
		$username = $zdb->qstr($username);
		$q = $zdb->Execute("SELECT * FROM ".tablename('users')." WHERE username = $username");
		if ($q && $q->RecordCount() == 1) return $q->fields;
		return false;
	}
	
	static public function GetDetailsById($id) {
		global $zdb;
		$id = $zdb->qstr($id);
		$q = $zdb->Execute("SELECT * FROM ".tablename('users')." WHERE userid = $id");
		if ($q && $q->RecordCount() == 1) return $q->fields;
		return false;
	}
	
	static public function GetDetail($detail) {
		if (self::loggedIn() === false) return false;
		if (isset($_SESSION['user'][$detail])) return $_SESSION['user'][$detail];
		else return false;
	}
	

	public static function recordLogin($username) {
		global $zdb;
		$zdb->Execute('UPDATE '.tablename('users').' SET lastlogin = GetDate() WHERE username = ' . $zdb->qstr($username));
	}
	
	public static function setCookie($username,$password) {
		setcookie('userinfo',serialize(Array('username'=>$username,'password'=>$password)),time()+2592000,'/');
	}
	
	public static function parseCookie() {
		if (Users::loggedIn() === true) return;
		
		if (isset($_COOKIE['userinfo'])) {
			if($ar = unserialize(stripslashes($_COOKIE['userinfo']))) {
				Users::Login($ar['email'],$ar['password'],true);
			}
		}
		
		// check autologin ip
		if (!isset($_SESSION['autoIPChecked'])) {
			global $zdb;
			$ip = $_SERVER['REMOTE_ADDR'];
			$bin = Users::convertIPtoDecimal($ip);
			
			$q = $zdb->SelectLimit("SELECT userid FROM ".tablename("users_autologin")." WHERE CAST('".$bin."' as bigint) & ((POWER(CAST(2 as bigint), mask) - 1) * POWER(CAST(2 as bigint), CAST(32 as bigint) - mask)) = range_from",1);
			if ($q && $q->RecordCount() > 0) {
				self::directLogin($q->fields['userid']);
			} else {
				$_SESSION['autoIPChecked']=true;
			}
		}
	}
	
	
	public static function OnlyLoggedInAJAX() {
		if (self::loggedIn() === false) {
			global $ui, $task;
			if (!isset($ui)) $ui = new UI;
			if (isset($_REQUEST['task']) && isset($task)) $ui->assign('page',$task[0]);
			$ui->display('control/redirectToLogin.html');
			exit;
		}
	}

	public static function OnlyLoggedIn() {
		if (self::loggedIn() === false) {
			if (isAJAXPage === true) {
				self::OnlyLoggedInAJAX();
			} else {
				gotoPage('/login.php');
			}
		}
	}
	
	public static function OnlyLoggedInManual() {
		if (self::loggedInManual() === false) {
			gotoPage('/forceLogin'.$_SERVER['REQUEST_URI']);
		}
	}
	
	
}
?>
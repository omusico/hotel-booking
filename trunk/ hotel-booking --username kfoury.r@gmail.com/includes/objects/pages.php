<?php

class Pages {

	public static function get($id) {
		global $zdb;
		$q = $zdb->Execute("SELECT * FROM pages WHERE id = ".intval($id));
		if ($q && $q->RecordCount() == 1) return $q->fields;
		else return false;
	}
	
	public static function getPage($shortname,$language) {
		global $zdb;
		
		$q = $zdb->Execute(sprintf("SELECT * FROM pages WHERE shortname = '%s' AND language = '%s'",$zdb->addq($shortname),$zdb->addq($language)));
		if ($q) return $q->fields;
		else return false;
	}

	public static function getAll($language,$start=0,$limit=false) {
		global $zdb;
		if ($start > 0 && $limit !== false) $q = $zdb->Execute("SELECT * FROM pages WHERE language = '".$zdb->addq($language)."' ORDER BY timestamp DESC LIMIT $start,$limit");
		else $q = $zdb->Execute("SELECT * FROM pages WHERE language = '".$zdb->addq($language)."' ORDER BY timestamp DESC");
		if ($q && $q->RecordCount() > 0) return $q->GetRows();
		else return false;
	}
	
	public static function add($title,$shortname,$language,$contents) {
		global $zdb;
		
		if (strlen($title) < 1 || strlen($shortname) < 1) return false;

		$title = htmlspecialchars($title, ENT_COMPAT, 'utf-8');
		$shortname = htmlspecialchars($shortname, ENT_COMPAT, 'utf-8');
		$contents = XSSClean($contents);
		
		$q = $zdb->Execute(sprintf("INSERT INTO pages (`title`,`shortname`,`language`,`timestamp`,`contents`) VALUES('%s','%s','%s',NOW(),'%s')",$zdb->addq($title),$zdb->addq($shortname),$zdb->addq($language),$zdb->addq($contents)));
		
		if ($q) return true;
		else {
			Log::add('(Pages::add) : fail: '.$zdb->ErrorMsg());
			return false;
		}
	}

	public static function edit($id,$title,$shortname,$language,$contents) {
		global $zdb;
		$old = self::get($id);
		if ($old === false) return false;
		
		if (strlen($title) < 1 || strlen($shortname) < 1) return false;
		
		$title = htmlspecialchars($title, ENT_COMPAT, 'utf-8');
		$shortname = htmlspecialchars($shortname, ENT_COMPAT, 'utf-8');
		$contents = XSSClean($contents);
		
		$q = $zdb->Execute(sprintf("UPDATE pages SET `title` = '%s', `shortname` = '%s', language = '%s', `timestamp` = NOW(), `contents` = '%s' WHERE id = '%u'",$zdb->addq($title),$zdb->addq($shortname),$zdb->addq($language),$zdb->addq($contents),$old['id']));
		
		if ($q) return true;
		else {
			Log::add('(Pages::edit) : '.$id.' fail: '.$zdb->ErrorMsg());
			return false;
		}
	}

	public static function delete($id) {
		global $zdb;
		$old = self::get($id);
		if ($old === false) return false;

		$q = $zdb->Execute("DELETE FROM pages WHERE id = ".$old['id']);
		if (!$q) return false;
		else return true;
	}

}


?>
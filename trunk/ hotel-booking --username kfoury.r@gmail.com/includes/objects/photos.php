<?php

class Photos {

	public static function GetPhoto($id) {
		global $zdb;
		$id = $zdb->qstr($id,get_magic_quotes_gpc());
		$sql = "SELECT `photos`.*, `albums`.`albumid` AS `albumid`, `albums`.`title`, `albums`.`photos` FROM `photos_items` AS `photos` RIGHT JOIN `photos_albums` AS `albums` ON `photos`.`albumid` = `albums`.`albumid` WHERE `photoid` = $id";
		$q = $zdb->Execute($sql);
		if (!$q || $q->RecordCount() != 1) { return false; }
		else {
			$data = $q->fields;
			$data['formatteddate'] = date('F j, Y',strtotime($data['timestamp']));
			return $data;
		}
	}
	
	public static function GetAlbumTotal($albumid) {
		global $zdb;
		$sql = "SELECT `photos` FROM `photos_albums` WHERE `albumid` = '$albumid'";
		$q = $zdb->Execute($sql);
		if (!$q || $q->RecordCount() != 1) { return false; }
		else return $q->fields[0];
	}
	
	public static function GetPreviousPhoto($photoid, $albumid) {
		global $zdb;
		
		$sql = "SELECT `photoid` FROM `photos_items` WHERE `albumid` = '$albumid' AND `photoid` < '$photoid' ORDER BY `photoid` DESC LIMIT 0,1";
		$q = $zdb->Execute($sql);
		if ($q) return $q->fields[0];
		else return 0;
	}
	
	public static function GetNextPhoto($photoid, $albumid) {
		global $zdb;
		
		$sql = "SELECT `photoid` FROM `photos_items` WHERE `albumid` = '$albumid' AND `photoid` > '$photoid' ORDER BY `photoid` ASC LIMIT 0,1";
		$q = $zdb->Execute($sql);
		if ($q) return $q->fields[0];
		else return 0;
	}
	
	public static function AddPhoto($albumid,$type,$thumburl,$photourl,$text,$date) {
		global $zdb;
		
		$q = $zdb->Execute("SELECT `order` FROM photos_items WHERE albumid = ".intval($albumid)." ORDER BY `order` DESC LIMIT 0,1");
		if ($q && $q->RecordCount() == 1) $order = ($q->fields[0])+1;
		else $order = 0;
		
		if ($date == '') $date = 'NULL';

		$sql = "INSERT INTO `photos_items` (`albumid`,`type`,`thumbnail`,`fullsize`,`timestamp`,`text`,`order`,`photodate`) ";
		$sql .= "VALUES('$albumid',".$zdb->qstr($type).",'$thumburl','$photourl',NOW(),'".$zdb->addq($text)."',$order,".$zdb->qstr($date).")";
		
		$q = $zdb->Execute($sql);
		if ($q) {
			$id = $zdb->Insert_ID();
			self::IncrementPhotos($albumid);
			return $id;
		}
		else return false;
	}
	
	public static function IncrementPhotos($id) {
		global $zdb;
		$zdb->Execute("UPDATE `photos_albums` SET `photos` = `photos` + 1 WHERE `albumid` = $id");
	}
	
	public static function DecrementPhotos($id) {
		global $zdb;
		$zdb->Execute("UPDATE `photos_albums` SET `photos` = `photos` - 1 WHERE `albumid` = $id");
	}
	
	public static function GetAlbum($id) {
		global $zdb;
		$id = $zdb->qstr($id,get_magic_quotes_gpc());
		$sql = "SELECT * FROM `photos_albums` WHERE `albumid` = $id";
		$q = $zdb->Execute($sql);
		if (!$q || $q->RecordCount() != 1) { return false; }
		else {
			$record = $q->fields;
			$record['pages'] = ceil($record['photos']/16);
			return $record;
		}
	}
	
	public static function GetAlbums($offset=0,$limit=0,$parentid=0) {
		global $zdb;
		if ($limit > 0) {
			$limitSQL = " LIMIT $offset,$limit ";
		} else {
			$limitSQL = '';
		}
		if ($parentid == 0) {
			$search = " WHERE parent = '0' ";
		} else {
			$search = " WHERE parent = '".intval($parentid)."' ";
		}
		$q = $zdb->Execute('SELECT * FROM `photos_albums` '.$search .' ORDER BY `order` ASC '.$limitSQL);
		if (!$q || $q->RecordCount() < 1) { return false; }
		else {
			$i = 0;
			$records = Array();
			while(!$q->EOF) {
				$records[$i] = $q->fields;
				$firstpic = $zdb->Execute('SELECT * FROM `photos_items` WHERE `albumid` = ' . intval($q->fields['albumid']) . ' ORDER BY `photos_items`.`order` ASC LIMIT 0,1');
				if ($firstpic && $firstpic->RecordCount() == 1) $records[$i]['firstPic'] = $firstpic->fields;
				$i++;
				$q->MoveNext();
			}
			return $records;
		}
	}
	
	public static function GetPhotos($albumid,$start=false,$limit=16) {
		global $zdb;
		$albumid = $zdb->qstr($albumid,get_magic_quotes_gpc());
		$sql = "SELECT `photoid`,`thumbnail`,`fullsize`,`photos_items`.`albumid`,`photos_items`.`order`, `photos_items`.`text`, `photos_items`.`photodate` FROM `photos_items` LEFT JOIN `photos_albums` ON `photos_items`.`albumid` = `photos_albums`.`albumid` WHERE `photos_items`.`albumid` = $albumid ORDER BY `photos_items`.`order` DESC";
		if ($start >= 0 && $start !== false) $sql .= " LIMIT $start,$limit";
		$q = $zdb->Execute($sql);
		if (!$q || $q->RecordCount() < 1) { return false; }
		else return $q->GetRows();
	}
	
	public static function GetPhotosByDate($albumid,$date='2000-01-01',$operator='>=',$start=false,$limit=16) {
		global $zdb;
		$albumid = $zdb->qstr($albumid,get_magic_quotes_gpc());
		$sql = "SELECT `photoid`,`thumbnail`,`fullsize`,`photos_items`.`albumid`,`photos_items`.`order`, `photos_items`.`text`, `photos_items`.`photodate` FROM `photos_items` LEFT JOIN `photos_albums` ON `photos_items`.`albumid` = `photos_albums`.`albumid` WHERE `photos_items`.`albumid` = $albumid AND `photodate` $operator '$date' ORDER BY `photos_items`.`order` DESC";
		if ($start >= 0 && $start !== false) $sql .= " LIMIT $start,$limit";
		$q = $zdb->Execute($sql);
		if (!$q || $q->RecordCount() < 1) { return false; }
		else return $q->GetRows();
	}
	
	public static function DeleteAlbum($aid) {
		global $zdb,$_ZEDNET;
		$album = Photos::GetAlbum($aid);
		if ($album === false) return false;
		$photos = self::GetPhotos($album['albumid'],-1,0);
		if ($photos !== false) {
			foreach($photos as $photo) {
				unlink($_ZEDNET['site']['MAIN_PATH'] . 'data/photos/' . $photo['thumbnail']);
				unlink($_ZEDNET['site']['MAIN_PATH'] . 'data/photos/' . $photo['fullsize']);
				$pid = $photo['photoid'];
				$aid = $photo['albumid'];
				$zdb->Execute("DELETE FROM `photos_items` WHERE `photoid` = '$pid'");
			}
		}
		$zdb->Execute("DELETE FROM `photos_albums` WHERE `albumid` = '$album[albumid]'");
	}
	
	public static function DeletePhoto($pid) {
		global $zdb,$_ZEDNET;
		$photo = self::GetPhoto($pid);
		if ($photo !== false) {
			if ($photo['thumbnail'] != '') unlink($_ZEDNET['site']['MAIN_PATH'] . 'data/photos/' . $photo['thumbnail']);
			unlink($_ZEDNET['site']['MAIN_PATH'] . 'data/photos/' . $photo['fullsize']);
			$zdb->Execute("DELETE FROM `photos_items` WHERE `photoid` = " . $zdb->qstr($pid));
			self::DecrementPhotos($photo['albumid']);
			return $photo['albumid'];
		} else return false;
	}
	
	public static function FindItemsBefore($photoid, $albumid) {
		// Finds the number of photos before the current one, within the specified album
		// photoId must exist in albumID or else this won't really work
		global $zdb;
		
		$sql = "SELECT COUNT(`photoid`) FROM `photos_items` WHERE `albumid` = '$albumid' AND `photoid` < '$photoid'";
		$q = $zdb->Execute($sql);
		if ($q) return $q->fields[0];
		else return 0;
	}

	public static function TemplateProvider($params, &$smarty) {

		if ($params['template'] == 'latest') {
			$photos = self::GetLatest($params['limit']);
			$smarty->assign('photos',$photos);
			$html = $smarty->fetch('shows/components/latest.html');
			$smarty->clear_assign('photos');
		} elseif ($params['template'] == 'full') {
			$var = $smarty->get_template_vars('instanceID');
			if (is_int($var)) $smarty->assign('instanceID',++$var);
			else $smarty->assign('instanceID',1);
			$photo = $params['photo'];

			$smarty->assign('photo',$photo);

			// Create Numbering
			$numberBefore = self::FindItemsBefore($photo['photoid'], $photo['albumid']);
			$numbering['current'] = $numberBefore + 1;
			$numbering['total'] = self::GetAlbumTotal($photo['albumid']);
			
			
			if ($numbering['current'] > 1) $numbering['previousID'] = self::GetPreviousPhoto($photo['photoid'], $photo['albumid']);
			if ($numbering['current'] < $numbering['total']) $numbering['nextID'] = self::GetNextPhoto($photo['photoid'], $photo['albumid']);
			
			$smarty->assign('numbering',$numbering);
			
			if ($smarty->get_template_vars('isPhotoJs') !== true) {
				$smarty->assign('isPhotoJs',true);
				$html = $smarty->fetch('shows/components/js.html');
			} else $html = '';
						
			$html .= $smarty->fetch('shows/components/photoviewer.html');
			
		}
		
		return $html;
	}
	
}

?>
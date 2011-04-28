<?php

class News {

	public static function get($id) {
		global $zdb;
		$q = $zdb->Execute("SELECT * FROM news WHERE id = ".intval($id));
		if ($q && $q->RecordCount() == 1) return $q->fields;
		else return false;
	}
	
	public static function getAll($language,$start=0,$limit=false) {
		global $zdb;
		if ($start > 0 && $limit !== false) $q = $zdb->Execute("SELECT * FROM news WHERE language = '".$zdb->addq($language)."' ORDER BY timestamp DESC LIMIT $start,$limit");
		else $q = $zdb->Execute("SELECT * FROM news WHERE language = '".$zdb->addq($language)."' ORDER BY timestamp DESC");
		if ($q && $q->RecordCount() > 0) return $q->GetRows();
		else return false;
	}
	
	public static function add($title,$file,$language,$date,$time,$contents) {
		global $zdb;
		$image = self::processImage($file);
		
		if (strlen($title) < 1) return false;
		
		$title = htmlspecialchars($title, ENT_COMPAT, 'utf-8');
		$contents = XSSClean($contents);
		
		$timestamp = strtotime($date.' '.$time);
		if ($timestamp < 1) $timestamp = time();
		
		$q = $zdb->Execute(sprintf("INSERT INTO news (`title`,`image`,`language`,`timestamp`,`contents`) VALUES('%s','%s','%s','%s','%s')",$zdb->addq($title),$image,$zdb->addq($language),date('Y-m-d H:i:s',$timestamp),$zdb->addq($contents)));
		
		if ($q) return true;
		else {
			Log::add('(News::add) : fail: '.$zdb->ErrorMsg());
			return false;
		}
	}

	public static function edit($id,$title,$file,$language,$date,$time,$contents) {
		global $zdb;
		$old = self::get($id);
		if ($old === false) return false;
		
		$image = self::processImage($file);
		if ($image !== false) {
			@unlink(FILE_DIR.$old['image']);
		} else {
			$image = $old['image'];
		}
		
		if (strlen($title) < 1) return false;
		
		$title = htmlspecialchars($title, ENT_COMPAT, 'utf-8');
		$contents = XSSClean($contents);
		
		$timestamp = strtotime($date.' '.$time);
		if ($timestamp < 1) $timestamp = time();
		
		$q = $zdb->Execute(sprintf("UPDATE news SET `title` = '%s', `image` = '%s', language = '%s', `timestamp` = '%s', `contents` = '%s' WHERE id = '%u'",$zdb->addq($title),$image,$zdb->addq($language),date('Y-m-d H:i:s',$timestamp),$zdb->addq($contents),$old['id']));
		
		if ($q) return true;
		else {
			Log::add('(News::edit) : '.$id.' fail: '.$zdb->ErrorMsg());
			return false;
		}
	}

	public static function delete($id) {
		global $zdb;
		$old = self::get($id);
		if ($old === false) return false;

		if (strlen($old['image']) > 0) @unlink(FILE_DIR.$old['image']);
		$q = $zdb->Execute("DELETE FROM news WHERE id = ".$old['id']);
		if (!$q) return false;
		else return true;
	}
	
	public static function processImage($file) {
	
		$fhandle = new zne_upload($file);
		if ($fhandle->uploaded) {
			if ($fhandle->file_is_image === true) {
				$fhandle->image_resize = true;
				$fhandle->image_convert = 'jpg';
				$fhandle->image_x = 670;
				$fhandle->image_y = 300;
				$fhandle->image_ratio = true;
				$fhandle->image_ratio_no_zoom_in = true;
				$fhandle->file_name_body_add = '_'.rand().rand();
				$fhandle->process(FILE_DIR);
				return $fhandle->file_dst_name;
			} else {
				Log::add('(News::processImage): Processing image failed.');
				return false;
			}
		} else {
			Log::add('(News::processImage): No image uploaded.');
			return false;
		}
	}

}

?>
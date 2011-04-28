<?php
class ZCache {
	
	public function &get($tpl) {
		//echo '<!-- Looking up '.$tpl.' -->';
		if (file_exists(CACHE_DIR.'tpl/'.$tpl)) {
			if (filemtime(CACHE_DIR.'tpl/'.$tpl) < time()-120) return false;
			return file_get_contents(CACHE_DIR.'tpl/'.$tpl);
		} else return false;
	}
	
	public function set($tpl,&$data,$compress=false,$time=60) {
		if (file_put_contents(CACHE_DIR.'tpl/'.$tpl,$data)) echo '<!-- CACHED '.$tpl.' -->';
		else echo '<!-- CACHE FAIL '.$tpl.' -->';
	}
	
	public function delete($tpl) {
		if (file_exists(CACHE_DIR.'tpl/'.$tpl)) {
			@unlink(CACHE_DIR.'tpl/'.$tpl);
		}
	}
	
	public function flush() {
		self::flushrecur(CACHE_DIR.'tpl/');
	}
	
	private function flushrecur($dir) {
		if(!$dh = @opendir($dir)) return;
		while (false !== ($obj = readdir($dh))) {
			if($obj=='.' || $obj=='..') continue;
			if (!@unlink($dir.'/'.$obj)) { }
		}
	    closedir($dh);
	}
	
}
?>
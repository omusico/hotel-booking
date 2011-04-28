<?php

class Log {
	
	public static function add($msg) {
		file_put_contents(LOG_FILE,date('Y-m-d H:i:s').' : '.$msg."\n",FILE_APPEND);
	}

}

?>
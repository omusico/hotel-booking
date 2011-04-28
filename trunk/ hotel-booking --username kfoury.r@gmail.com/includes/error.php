<?php
if (!defined('IN_ZEDNET')) exit;

function zne_error($message) {
	global $_ZEDNET;
 	echo("<h1>" . $_ZEDNET['site']['sitename'] . "</h1>
	<strong><small>Error</small></strong><br />
	$message<br />
	Please try again later or contact us.<br />
	<br />
	<small>Generated on " . gmdate('F d, Y H:i:s') . " GMT.</small>");
	//notifyAdmin($message);
	exit;
}

function notifyAdmin($message) {
	global $_ZEDNET;
	
	// Check whether to notify admin or not
	$status = CACHE_DIR."error_status";
	$newerrors = 1;
	$noemail = false;
	if (file_exists($status)) {
		$errors = intval(file_get_contents($status));
		if (filemtime($status) > time()-7200) {
			if ($errors > 5) $noemail = true;
		}
		$newerrors = $errors+1;
	} 

	file_put_contents($status,$newerrors);
	
	$file = CACHE_DIR."debug_".time().'_'.rand().".html";
	
	
	ob_start();
	
	echo("Time: ".gmdate('F d, Y H:i:s')." GMT (Unix: ".time().")<br /><br />ZEDNET Dump:<br /><br />");
	echo(nl2br(print_r($_ZEDNET,true)));
	echo("<br /><br />PHP Configuration:<br /><br />");
	phpinfo();
	
	file_put_contents($file, ob_get_contents());
	
	ob_end_clean();
	
	if ($noemail === false) {
		$mail = new Email;
		$mail->From = 'alerts@lorientlejour.com';
		$mail->Subject = 'Web server error alert';
		$mail->AddAddress($_ZEDNET['contact']['email']);
		$mail->AddAttachment($file);
		$mail->Body = "An error occurred on the L'Orient-Le Jour web site. The error message is:\n\n".$message."\n\nCheck the attached debug file for more information.";
		$mail->Send();
	}
	
}

?>
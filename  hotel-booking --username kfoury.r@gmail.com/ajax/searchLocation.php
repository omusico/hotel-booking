<?php
require('../includes/main.php');

$q = $zdb->Execute("SELECT `locations`.*, `countries`.`countryname` FROM `locations` NATURAL JOIN `countries` WHERE `locationname` LIKE '%".$zdb->addq($_REQUEST['term'])."%' ");
if ($q && $q->RecordCount() > 0) {
	while(!$q->EOF) {
		$data[] = Array('id'=>$q->fields['locationid'], 'value' => $q->fields['locationname']. ', ' . $q->fields['countryname']);
		$q->MoveNext();
	}
	echo (json_encode($data));
} else {
	echo 'Error';
}
?>
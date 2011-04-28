<?php
require('includes/main.php');

$ui = new UI;

try {

	$h = new Hotel;
	if (isset($_REQUEST['locationid'])) $hotels = $h->getAll('locationid',intval($_REQUEST['locationid']));
	else $hotels = $h->getAll();
	foreach($hotels as $k=>$v) {
		$l = new Location($v['locationid']);
		$hotels[$k]['location'] = $l->data;
		$c = new Country($l->data['countryid']);
		$hotels[$k]['country'] = $c->data;
	}
	$ui->assign('hotels',$hotels);
	
	$ui->display('searchresults.html');

} catch (Exception $e) {
	echo $e->getMessage();
}

?>
<?php
require('includes/main.php');
include('includes/objects/hotel.php');
include('includes/objects/location.php');

$ui = new UI;

try {

if (isset($_REQUEST['id'])) {
	$hotel = new Hotel($_REQUEST['id']);
	$ui->assign('hotel',$hotel->data);
	$l = new Location($hotel->data['locationid']);
	$ui->assign('location',$l->data);
	$ui->assign('locations', $l->getAll('countryid', $l->data['countryid']));
}

$c = new Country;
$ui->assign('countries',$c->getAll());

} catch(Exception $e) {
	echo $e->getMessage();
	exit;
}

$ui->display('infoHotel.html');
?>
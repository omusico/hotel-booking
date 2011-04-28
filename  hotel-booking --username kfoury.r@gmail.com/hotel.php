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
}

} catch(Exception $e) {
	echo $e->getMessage();
	exit;
}

$pageTitle = $hotel->data['hotelname'];

$ui->display('hotel.html');
?>
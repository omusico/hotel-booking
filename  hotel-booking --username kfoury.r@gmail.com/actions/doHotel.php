<?php
require('../includes/main.php');
include('../includes/objects/hotel.php');
include('../includes/objects/location.php');


try {
	
	switch($_REQUEST['action']) {
	
		case 'add':
			$h = new Hotel;
			$h->data = $_REQUEST;
			$h->save();
			gotoPage('../infoHotel.php?id='.$h->id().'&msg=success');
		break;

		case 'edit':
			$h = new Hotel($_REQUEST['id']);
			$h->data = $_REQUEST;
			$h->save();
			gotoPage('../infoHotel.php?id='.$h->id().'&msg=success');
		break;
		
		case 'remove':
			$h = new Hotel($_REQUEST['id']);
			$h->delete();
			gotoPage('../hotels.php?delete');
		break;
		
	}
		
	
/*
$h->data['hotelname'] = $_POST['hotelname'];
$h->data['rating'] = $_POST['rating'];
$h->data['locationid'] = $_POST['locationid'];
$h->data['type'] = $_POST['type'];
if (isset($_POST['pool']))
	$h->data['pool'] = 1;
if (isset($_POST['spa']))
	$h->data['spa'] = 1;
$h->data['restaurants'] = $_POST['restaurants'];
$h->data['wifi'] = $_POST['wifi'];
$h->data['internet'] = $_POST['internet'];
$h->data['parking'] = $_POST['parking'];
if (isset($_POST['disable_friendly']))
	$h->data['disable_friendly'] = 1;
if (isset($_POST['pets']))
	$h->data['pets'] = $_POST['pets'];
if (isset($_POST['meetingrooms']))
	$h->data['meetingrooms'] = 1;
if (isset($_POST['airport_shuttle']))
	$h->data['airport_shuttle'] = 1;
if (isset($_POST['gay_friendly']))
	$h->data['gay_friendly'] = 1;
if (isset($_POST['shopping_center']))
	$h->data['shopping_center'] = 1;
if (isset($_POST['express_checking']))
	$h->data['express_checking'] = 1;
if (isset($_POST['bar']))
	$h->data['bar'] = 1;
if (isset($_POST['nonsmokingareas']))
	$h->data['nonsmokingareas'] = 1;
if (isset($_POST['safedepositbox']))
	$h->data['safedepositbox'] = 1;
if (isset($_POST['luggagestorage']))
	$h->data['luggagestorage'] = 1;
if (isset($_POST['laundry']))
	$h->data['laundry'] = 1;
*/
	
} catch(Exception $e) {
	$msg = "fail";
	echo $e->getMessage();
}

?>		 	 	 	 	 	 	
<?php
require('includes/main.php');
include('includes/objects/hotel.php');
include('includes/objects/location.php');

/*
try { 
$l = new Location();
$l->data['locationname'] = 'Jbeil';
$l->data['countryid'] = 1;
$l->data['locationtype'] = 1;
$l->save();
echo 'ID: '. $l->id();
} catch(Exception $e) {
	echo $e->getMessage();
}
*/

$var = 'Hotel';
$h = new $var();

$h->data['hotelname'] = 'Rudy in Jbeil';
$h->data['rating'] = 1;
$h->data['locationid'] = 1;

try {
	//$h->save();
} catch(Exception $e) {
	echo $e->getMessage();
}


/*
try {
$h = new Hotel(4);
$h->data['hotelname'] = 'Wadih';
$h->save();
} catch(Exception $e) {
	echo $e->getMessage();
}

exit;
*/

$ui = new UI;
$ui->display('index.html');
?>
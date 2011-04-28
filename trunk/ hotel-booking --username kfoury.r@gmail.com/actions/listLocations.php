<?php
require('../includes/main.php');

$l = new Location;
$locs = $l->getAll('countryid',$_REQUEST['countryid']);
if ($locs) {
	echo '<select name="locationid">';
	foreach($locs as $v) {
		echo '<option value="'.$v['locationid'].'">'.$v['locationname'].'</option>';
	}
	echo '</select>';
} else {
	echo 'No locations found in this country.';
}
?>
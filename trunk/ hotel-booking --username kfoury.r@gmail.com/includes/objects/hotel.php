<?php

class Hotel extends Entry {

	protected $table = 'hotels';
	protected $pKey = 'hotelid';
	protected $orderKey = 'hotelname';

	protected function validate() {
	
		try {
			if (trim($this->data['hotelname']) == '') throw new Exception('Hotel name not specified.');
		} catch(Exception $e) {
			$this->validationError = $e->getMessage();
			return false;
		}
	
	}

}

?>
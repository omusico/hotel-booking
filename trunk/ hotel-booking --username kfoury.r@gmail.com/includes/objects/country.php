<?php

class Country extends Entry {

	protected $table = 'countries';
	protected $pKey = 'countryid';
	protected $orderKey = 'countryname';

	protected function validate() {
	
		try {
			if (trim($this->data['countryname']) == '') throw new Exception('Country name not specified.');
		} catch(Exception $e) {
			$this->validationError = $e->getMessage();
			return false;
		}
	
	}
	
}

?>
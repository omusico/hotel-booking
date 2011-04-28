<?php

class Location extends Entry {

	protected $table = 'locations';
	protected $pKey = 'locationid';
	protected $orderKey = 'locationname';

	protected function validate() {
	
		try {
			if (trim($this->data['locationname']) == '') throw new Exception('Location name not specified.');
		} catch(Exception $e) {
			$this->validationError = $e->getMessage();
			return false;
		}
	
	}
	
}

?>
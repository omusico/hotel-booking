<?php

class Entry {

	private $isNew;
	private $errorMsg;
	public $data;
	private $validationError;
	private $id;
	private $originalData;
	
	protected $table = '';
	protected $pKey = '';
	protected $orderKey = '';
	
	function __construct($id=false) {
		global $zdb;
		
		if ($id == '') $id = false;
		
		if ($id === false) {
			$this->isNew = true;
			$q = $zdb->Execute("DESCRIBE `".$this->table."`");
			if ($q) {
				while(!$q->EOF) {
					$this->data[$q->fields['Field']] = '';
					$this->originalData[$q->fields['Field']] = '';
					$q->MoveNext();
				}
			}
		} else {
			$this->isNew = false;
			
			$q = $zdb->Execute("SELECT * FROM `".$this->table."` WHERE `".$this->pKey."` = ".intval($id));
			if (!$q || $q->RecordCount() == 0) throw new Exception('No such item.');
			$this->data = $q->fields;
			$this->originalData = $q->fields;
			$this->id = $q->fields[$this->pKey];
		}
	}
	
	public function id() { return $this->id; }
	
	public function save() {
		global $zdb;
	
		if ($this->validate() === false) throw new Exception($this->validationError);
	
		if ($this->isNew === true) {
			// INSERT
			$sql = "INSERT INTO `".$this->table."` (";
			foreach($this->data as $k=>$v) {
				if ($k == $this->pKey) continue;
				// only allow valid columns
				if (!isset($this->originalData[$k])) continue;

				$sql .= "`".$zdb->addq($k)."`,";
			}
			$sql = substr($sql,0,-1).") VALUES(";
			foreach($this->data as $k=>$v) {
				if ($k == $this->pKey) continue;
				// only allow valid columns
				if (!isset($this->originalData[$k])) continue;

				$sql .= "'".$zdb->addq($v)."',";
			}
			$sql = substr($sql,0,-1).")";
			$q = $zdb->Execute($sql);
			if ($q) {
				$this->id = $zdb->Insert_ID();
			} else {
				throw new Exception('Unable to add new entry: '.$zdb->ErrorMsg());
			}
		} else {
			// UPDATE
			$sql = "UPDATE `".$this->table."` SET ";
			$count = 0;
			foreach($this->data as $k=>$v) {
				if ($k == $this->pKey) continue;
				// only allow valid columns
				if (!isset($this->originalData[$k])) continue;
				// only update modified values
				if ($v != $this->originalData[$k]) {
					$sql .= "`".$zdb->addq($k)."` = '".$zdb->addq($v)."', ";
					$count++;
				}
			}
			if ($count == 0) return true;
			$sql = substr($sql,0,-2) . " WHERE `".$this->pKey."` = ".$this->id;
			$q = $zdb->Execute($sql);
		}
		
		if ($q) return true;
		else throw new Exception('Save error: '.$zdb->ErrorMsg());
	}
	
	/*
	** To be run before saving to database 
	*/
	protected function validate() {
	}
	
	public function delete() {
		global $zdb;
		
		if ($this->isNew === true) throw new Exception('Cannot delete non-existent item.');
		$q = $zdb->Execute("DELETE FROM `".$this->table."` WHERE `".$this->pKey."` = ".$this->id);
		if ($q) return true;
		else throw new Exception('Unable to delete item.');
	}
	
	public function getAll($keyName=false, $keyValue=false) {
		global $zdb;
		if ($keyName === false) $q = $zdb->Execute("SELECT * FROM `".$this->table."` ORDER BY `".$this->orderKey."` ASC");
		else $q = $zdb->Execute("SELECT * FROM `".$this->table."` WHERE `".$zdb->addq($keyName)."` = '".$zdb->addq($keyValue)."' ORDER BY `".$this->orderKey."` ASC");
		if (!$q || $q->RecordCount() == 0) return false;
		else return $q->GetRows();
	}

}

?>
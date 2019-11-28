<?php

class AppTable {

	public $table = '';
	public $id = null;

	// Blacklist tables that are not allowed for direct access
	private $blacklist = [ 'User' ];

	public function getContent() {

		$db = DB::getInstance();

		// Not possible to bind a table or column name with PDO
		if ($this->isAllowed()) {
			$base_sql = "SELECT * FROM {$this->table}";
		}

		// TODO empty set handling
		if ($this->id !== null) {
			return $db->getResults("{$base_sql} WHERE ID = :id", [ 'id' => $this->id ]);
		} else {
			return $db->getResults($base_sql);
		}
	}

	public function isAllowed() {
		return !in_array($this->table, $this->blacklist);
	}
}

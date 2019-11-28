<?php

// TODO introduce an Interface to all App objects
class AppTable {

	public $table = '';
	public $id = null;

	// Blacklist database objects that are not allowed for direct access
	private $blacklist = [ 'User' ];

	// Application Context
	private $context = null;

	public function __construct(Context $ctx) {
		$this->context = $ctx;
	}

	public function getContent() {

		$db = DB::getInstance();

		// Not possible to bind a table or column name with PDO
		if ($this->isAllowed()) {
			$base_sql = "SELECT * FROM {$this->context->table}";
		}

		// TODO empty set handling
		if ($this->id !== null) {
			return $db->getResults("{$base_sql} WHERE ID = :id", [ 'id' => $this->context->id ]);
		} else {
			return $db->getResults($base_sql);
		}
	}

	public function isAllowed() {
		return !in_array($this->context->table, $this->blacklist);
	}
}

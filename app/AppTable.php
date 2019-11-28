<?php

// TODO introduce an Interface to all App objects
class AppTable {

	// Blacklist database objects that are not allowed for direct access
	private $blacklist = [ 'User' ];

	// Application Context
	private $context = null;

	// Table type Object specific properties
	private $table = null;
	private $id = null;

	public function __construct(Context $ctx) {
		$this->context = $ctx;

		// Extract table name and id
		$args = $ctx->getArgs();
		$this->table = $ctx->getArg('table');
		$this->id = $ctx->getArg('id');
	}

	public function getContent() {
		$db = DB::getInstance();

		// Not possible to bind a table or column name with PDO
		if ($this->isAllowed()) {
			$base_sql = "SELECT * FROM {$this->table}";
		}

		// TODO empty set handling
		if (!empty($this->id)) {
			return $db->getResults("{$base_sql} WHERE ID = :id", [ 'id' => $this->id ]);
		} else {
			return $db->getResults($base_sql);
		}
	}

	public function isAllowed() {
		return !in_array($this->table, $this->blacklist);
	}
}

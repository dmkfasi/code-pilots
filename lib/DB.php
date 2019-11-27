<?php

class DB extends PDO {

	private static $instance = null;

  public function __construct()
  {
		$cfg = Config::getInstance();

		// Construct DSN since ini file can't contain equal sign in a value
		$dsn = "{$cfg->driver}:{$cfg->dbname};host={$cfg->host}";

		try {
	    parent::__construct($sn, $cfg->username, $cfg->password);
		} catch (PDOException $e) {
			throw new ApplicationException('Unable to instantiate PDO driver: ' . $e->getMessage());
		}
  }

	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new DB();
		}

		return self::$instance;
	}
}

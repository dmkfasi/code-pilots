<?php

class DB extends PDO {

	private static $instance = null;

  public function __construct()
  {
		$cfg = Config::getInstance();

		// Construct DSN since ini file can't contain equal sign in a value
		$dsn = "{$cfg->driver}:dbname={$cfg->dbname};host={$cfg->host}";

		try {
	    parent::__construct($dsn, $cfg->username, $cfg->password);
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

	public function execute(string $sql, array $params = []) {
    try {
      $sth = $this->prepare($sql);                                                                                                                                           
      $sth->execute($params);
    } catch (PDOException $e) {
      throw new ApplicationException('Unable to prepare SQL: ' . $e->getMessage());
    }

    return $sth;
	}

  public function getResults(string $sql, array $params = []) {
    $sth = $this->execute($sql, $params);

		return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}

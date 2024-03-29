<?php

class Config {

	private $filename = 'config.ini';
	private static $instance = null;
	private $settings = null;

	public function load() {

		if (empty($this->filename)) {
			throw new ApplicationException('No config file name specified');
		} elseif (!is_readable($this->filename)) {
			throw new ApplicationException('Specified config file is not readable');
		}

		$this->settings = parse_ini_file($this->filename);
	}

	public function setFilename(string $filename = 'config.ini') {
		$this->filename = $filename;
	}

	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new Config();
		}

		return self::$instance;
	}

	public function __get(string $var) {
		if ($this->settings === null) {
			$this->load();
		}

		return $this->settings[$var];
	}
}

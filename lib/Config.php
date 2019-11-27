class Config {

	public function __construct($filename = 'settings.ini') {

		if (empty($filename)) {
			throw new Exception('No config file name specified');
		} elseif (!is_readable($filename) {
			throw new Exception('Specified config file is not readable');
		}

		$this->settings = parse_ini_file($filename);
	}

}

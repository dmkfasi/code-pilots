class DB extends PDO {

  public function __construct($dsn, $user = null, $pass = null)
  {
    parent::__construct($dsn, $user, $pass);

    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (version_compare(PHP_VERSION, '5.1.3', '>='))
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
  }

}

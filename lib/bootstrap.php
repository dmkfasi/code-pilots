<?php

require_once('Config.php');
require_once('DB.php');

$cfg = Config::getInstance();
$cfg->load();

debug($cfg->dsn);

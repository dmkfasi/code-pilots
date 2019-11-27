<?php

require_once('Config.php');
require_once('DB.php');
require_once('Request.php');
require_once('Response.php');

Config::getInstance()->load();

debug($cfg->dsn);

function debug($o) {
	print_r("<pre>{$o}</pre>");
}

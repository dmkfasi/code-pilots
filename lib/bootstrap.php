<?php

require_once('ApplicationException.php');
require_once('Config.php');
require_once('DB.php');
require_once('Request.php');
require_once('Response.php');

// Basic objects

// Configuration singleton
$cfg = Config::getInstance()->load();
$db = DB::getInstance();

$request = new Request();
$response = new Response();

debug($db);

function debug($o) {
	echo '<pre>';
	print_r($o);
	echo '</pre>';
}

<?php

// Refactor: add autoloader
require_once('ApplicationException.php');
require_once('Config.php');
require_once('Context.php');
require_once('DB.php');
require_once('Request.php');
require_once('Response.php');

// Basic objects

// Configuration singleton
$cfg = Config::getInstance()->load();
$db = DB::getInstance();

$request = new Request(new Context());
$response = new Response();

$response->setPayload($request->getContent());
//$db->getResults('SELECT * FROM News WHERE ID = :ID', [ 'ID' => 1 ]);

function debug($o) {
	$response = new Response();
	$response->setPayload([$o]);
	$response->dispatch();
}

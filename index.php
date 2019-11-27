<?php

phpinfo();

require_once 'Response.php';

// Basic HTTP router

$res = new Response();

$res->setStatus(200);
$res->setMessage('Everything is fine');

debug($res->toJson());

$res->dispatch();

function debug($o) {
	print_r("<pre>{$o}</pre>");
}

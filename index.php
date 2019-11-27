<?php

// Basic bootstrapping
require_once 'lib/bootstrap.php';

// Basic HTTP router
$res = new Response();

$res->setStatus('ok');
$res->setMessage('Everything is fine');

//debug($res->toJson());

$res->dispatch();

function debug($o) {
	print_r("<pre>{$o}</pre>");
}

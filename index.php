<?php

// Basic bootstrapping
require_once 'lib/bootstrap.php';

// Basic HTTP response
$response->setContentType('text/plain');
$response->setStatus('ok');
$response->setMessage('Everything is fine');

$res->dispatch();


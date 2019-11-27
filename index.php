<?php

// Basic bootstrapping
require_once 'lib/bootstrap.php';

// Basic HTTP router
$req = new Request();

// Basic HTTP response
$res = new Response();
$res->setStatus('ok');
$res->setMessage('Everything is fine');
$res->dispatch();


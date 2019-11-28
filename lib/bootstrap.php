<?php

// Load core components in the first place
require_once 'lib/ApplicationException.php';

// TODO refactor me
spl_autoload_register(function ($class) {
	// Application classes are in separate folder
	$file_path = (strpos($class, 'App') === 0) ? "app/{$class}.php" : "lib/{$class}.php";

	if (is_readable($file_path)) {
		require_once $file_path;
	} else {
		// TODO logging
		throw new ApplicationException("Unable to load component required {$class}");
	}

});

// Basic objects

// Configuration singleton
$cfg = Config::getInstance()->load();

// Flow context
$ctx = new Context();

$request = new Request($ctx);

$response = new Response();
$response->setup($ctx);

function debug($o) {
	$r = new Response();
	$r->setStatus('debug');
	$r->setContentType('text/plain');
	$r->setPayload(print_r($o, true));
	$r->setMessage('Debug function called');
	$r->dispatch();
}

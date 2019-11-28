<?php

// Refactor this to work with a URL class
class Context {

	private $uri = '';
	private $path = '';
	private $method = '';

	private $action = null;
	private $subject = null;
	private $args = null;

	private $content = null;

	public function __construct() {
		$this->setRequestMethod();
		$this->setUri();
		$this->setPath();
		$this->setRoute();
	}

	public function getRequestMethod() {
		return $this->method;
	}

	public function setRequestMethod() {
		$this->method = $_SERVER['REQUEST_METHOD'];
	}

	public function getUri() {
		return $this->uri;
	}

	public function setUri() {
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function getPath() {
		return $this->path;
	}

	public function setPath() {
		// Strip out 'api' part
		$uri = str_replace('api', '', $this->uri);
		$this->path = trim($uri, '/');
	}

	public function getAction() {
		return $this->action;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function getArgs() {
		return $this->args;
	}

	// Sets attributes to run an application
	// TODO refactor
	public function setRoute() {
		list($this->action, $this->subject, $this->args) = explode('/', $this->path);
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}
}

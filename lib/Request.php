<?php

class Request {

	public function __construct(Context $ctx) {
		$this->context = $ctx;

		$method = $this->context->getRequestMethod();

		switch ($method) {
			case 'HEAD':
			case 'PUT':
			default:
				throw new ApplicationException("HTTP method '{$m}' is not supported");
				break;

			case 'GET':
			case 'POST':
				$this->runPost();
				break;
		}
	}

	private function runPost() {
		debug($this->context->getAction());
	}

}

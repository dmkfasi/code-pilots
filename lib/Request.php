<?php

class Request {

	protected $context = null;

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
		$obj_name = 'App' . $this->context->getAction();

		if (class_exists($obj_name)) {
			$app = new $obj_name();
			$app->table = $this->context->getSubject();
			$app->id = $this->context->getArgs();

			// Assert App content into context for output
			$this->context->setContent($app->getContent());
		} else {
			throw new ApplicationException('Requested method not found');
		}
	}

}

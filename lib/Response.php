<?php

/* 
 * Implements basic HTTP response object
 */

class Response {

  public $status = 'ok';
  public $payload = [];
  public $message = 'Everything is fine';
  private $content_type = 'application/json';

  public function setStatus(string $status) {
    $this->status = $status;
  }

  public function setPayload($payload) {
		// Convert any output to an array
		if (!is_array($payload)) {
			$payload = [ $payload ];
		}

		$this->payload = $payload;
	}

  public function setMessage(string $message) {
    $this->message = $message;
  }

  public function setContentType(string $mime) {
    $this->content_type = $mime;
  }

  public function toJson() {
    return json_encode($this);
  }

  public function dispatch() {
    $content = $this->toJson();

    header('Content-type: ' . $this->content_type);
    header('Content-Length: ' . strlen($content));
    die($content);
  }

	public function setup(Context $ctx) {
		// Collect output buffer from Context to
		// convert it to an actual HTTP response
		$output = $ctx->getContent();

		// Override response type and data if set with Context
		if (!empty($output['content_type'])) {
			$this->setContentType($output['content_type']);
		}

		if (!empty($output['message'])) {
			$this->setMessage($output['message']);
		}

		if (!empty($output['status'])) {
			$this->setStatus($output['status']);
		}

		// Whenever there is no overriden payload,
		// use output object directly
		if (!empty($output['payload'])) {
			$this->setPayload($output['payload']);
		} else {
			$this->setPayload($output);
		}
	}

  public function __toString() {
    return $this->message;
  }
  
}

<?php

/* 
 * Implements basic HTTP response object
 */

class Response {

  public $status = '';
  public $payload = [];
  public $message = '';
  private $content_type = 'application/json';

  public function setStatus(string $status) {
    $this->status = $status;
  }

  public function setPayload(array $payload) {
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

  public function __toString() {
    return $this->message;
  }
  
}
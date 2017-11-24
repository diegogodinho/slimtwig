<?php

namespace App\Domain;

class ErrorJson {	
	public $Message;

	public function __construct($msg) {
		$this->Message = $msg;
	}
}
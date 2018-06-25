<?php

namespace App\Domain;

class ErrorJson {	
	public $mensagem;

	public function __construct($msg) {
		$this->mensagem = $msg;
	}
}
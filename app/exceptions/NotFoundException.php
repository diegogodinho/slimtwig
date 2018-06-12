<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception {		
	function __construct($msg = "Item nao encontrado") {			
		parent::__construct($msg);
		
	}	
}
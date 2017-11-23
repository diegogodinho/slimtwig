<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception {		
	function __construct($msg = "Record not found") {			
		parent::__construct($msg);
		
	}	
}
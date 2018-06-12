<?php


namespace App\Validation;

use Respect\Validation\Rules\AbstractRule; 
use App\Domain\Usuario;


class EmailValidator extends AbstractRule
{   
    public function validate($input)
    {
        $emailResult = Usuario::where('email','=',$input)->count();
        
        return $emailResult <= 0;
    }

}

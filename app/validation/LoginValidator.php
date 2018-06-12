<?php


namespace App\Validation;

use Respect\Validation\Rules\AbstractRule; 
use App\Domain\Usuario;


class LoginValidator extends AbstractRule
{   
    public function validate($input)
    {
        $result = Usuario::where('login','=',$input)->count();
        
        return $result <= 0;
    }

}

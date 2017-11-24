<?php


namespace App\Validation;

use Respect\Validation\Rules\AbstractRule; 
use App\Domain\User;


class LoginValidator extends AbstractRule
{   
    public function validate($input)
    {
        $result = User::where('login','=',$input)->count();
        
        return $result <= 0;
    }

}

<?php


namespace App\Validation;

use Respect\Validation\Rules\AbstractRule; 
use App\Domain\User;


class EmailValidator extends AbstractRule
{   
    public function validate($input)
    {
        $emailResult = User::where('email','=',$input)->count();
        
        return $emailResult <= 0;
    }

}

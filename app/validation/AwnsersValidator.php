<?php


namespace App\Validation;

use Respect\Validation\Rules\AbstractRule; 
use App\Domain\User;


class AwnsersValidator extends AbstractRule
{   
    public function validate($input)
    {
        //var_dump($input);
        //die();
        $foundRightAwnser = false;

        foreach ($input as $key => $value) {
            if (!$foundRightAwnser && $value['right_awnser'] == 1)
            {
                $foundRightAwnser = true;
            }            
            
            if (empty($value['description']))
            {
                return false;
            }            
        }
        return !$foundRightAwnser ? false: true;
    }

}

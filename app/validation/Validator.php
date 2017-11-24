<?php


namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;
use App\Domain\ErrorJson;


class Validator
{
    public $erros;

    public function Validate($request, array $rules)
    {         

        foreach ($rules as $field => $rule) {
            try 
            {
                $value = $request->getParam($field);
                if (!$value)
                {
                    $value = $request->getAttribute($field);
                }

                $rule->setName(ucfirst($field))->assert($value);
            }
            catch(NestedValidationException $e)
            {
                $this->erros[$field] = $e->getMessages();
            }            
        }   
        
        $_SESSION['validation_erros'] = $this->erros;
    }

    public function Valid()
    {
        return empty($this->erros);
    }

    public function GetJsonMessages()
    {
        $objectReturn = array();
        foreach ($this->erros as $key => $value) {
            $objectReturn[] =  new ErrorJson($value);
        }
        return $objectReturn;
    }
}

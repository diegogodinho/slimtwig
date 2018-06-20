<?php
namespace App\Validation;

use App\Domain\ErrorJson;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    public $erros;

    public function Validate($request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try
            {
                $value = $request->getParam($field);
                if (!$value) {
                    $value = $request->getAttribute($field);
                }

                $rule->setName(ucfirst($field))->assert($value);
            } catch (NestedValidationException $e) {
                $errors = $e->findMessages([
                    'notEmpty' => '{{name}} deve ser informado(a)',
                    'noWhitespace' => '{{name}} nao pode conter somente espacos',
                    'email' => '{{name}} deve ser um e-mail valido.',
                    'date' => '{{name}} deve ser uma data valida.',
                    'length'=>'{{name}} dete ter um tamanho entre {{minValue}} e {{maxValue}}'

                ]);
                $this->erros[$field] = $e->getMessages();
            }
        }
        // if ($this->erros) {
        //     var_dump($this->erros);
        //     die();
        // }
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
            $objectReturn[] = new ErrorJson($value);
        }
        return $objectReturn;
    }
}

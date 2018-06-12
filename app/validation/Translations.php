<?php

namespace App\Validation;

class Translation
{
    private static $translationSentence = [
        "must not be empty" => "deve ser informado",
        "must be valid email" => "deve ser um e-mail valido",
    ];

    public static function Translate($erros)
    {
        foreach ($erros as $Errokey => &$Errovalue) {
            foreach (static::$translationSentence as $key => $value) {
                $Errovalue = str_replace($key, $value, $Errovalue);
            }
        }
        return $erros;
    }
}

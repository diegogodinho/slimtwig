<?php

namespace App\Validation;

use Respect\Validation\Exceptions\ValidationException;

class EmailValidatorException extends ValidationException 
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} ja existe!' // or any message you want
        ]
    ];
}


<?php

namespace App\Validation;

use Respect\Validation\Exceptions\ValidationException;

class AwnsersValidatorException extends ValidationException 
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Awnser description cannot be empty and at least one awnser should be right!'
        ]
    ];
}

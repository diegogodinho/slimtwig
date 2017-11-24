<?php
/*
Validation
*/
require __DIR__ . '/validation/Validator.php';
require __DIR__ . '/validation/AwnsersValidator.php';
require __DIR__ . '/validation/AwnsersValidatorException.php';
require __DIR__ . '/validation/EmailValidator.php';
require __DIR__ . '/validation/EmailValidatorException.php';
require __DIR__ . '/validation/LoginValidator.php';
require __DIR__ . '/validation/LoginValidatorException.php';

use Respect\Validation\Validator as v;

v::with('App\\Validation');

/*
Controllers
*/
require __DIR__ . '/controllers/BaseController.php';
require __DIR__ . '/controllers/CRUDController.php';
require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/LoginController.php';
require __DIR__ . '/controllers/UserController.php';
/*
Domain
*/
require __DIR__ . '/domain/Awnser.php';
require __DIR__ . '/domain/Question.php';
require __DIR__ . '/domain/User.php';
require __DIR__ . '/domain/ErrorJson.php';

/*
Middleware
*/
require __DIR__ . '/middleware/Middleware.php';
require __DIR__ . '/middleware/ValidationErrorsMiddleware.php';
<?php
use Respect\Validation\Validator as v;
v::with('App\\Validation');

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
require __DIR__ . '/validation/Translations.php';
/*
Controllers
*/
require __DIR__ . '/controllers/BaseController.php';
require __DIR__ . '/controllers/CRUDController.php';
require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/LoginController.php';
require __DIR__ . '/controllers/UsuarioController.php';
require __DIR__ . '/controllers/FotoController.php';
require __DIR__ . '/controllers/TagController.php';
/*
Domain
*/
require __DIR__ . '/domain/Usuario.php';
require __DIR__ . '/domain/ErrorJson.php';
require __DIR__ . '/domain/Foto.php';
require __DIR__ . '/domain/Tag.php';

/*
Middleware
*/
require __DIR__ . '/middleware/Middleware.php';
require __DIR__ . '/middleware/ValidationErrorsMiddleware.php';
require __DIR__ . '/middleware/OldMiddleware.php';
require __DIR__ . '/middleware/AuthorizationMiddleware.php';





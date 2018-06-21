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
require __DIR__ . '/controllers/ItemImovelController.php';
require __DIR__ . '/controllers/ClienteController.php';
require __DIR__ . '/controllers/TipoImovelController.php';
require __DIR__ . '/controllers/GrupoController.php';
require __DIR__ . '/controllers/EstadoController.php';
require __DIR__ . '/controllers/CidadeController.php';
require __DIR__ . '/controllers/BairroController.php';
/*
Domain
*/
require __DIR__ . '/domain/Usuario.php';
require __DIR__ . '/domain/ErrorJson.php';
require __DIR__ . '/domain/Foto.php';
require __DIR__ . '/domain/ItemImovel.php';
require __DIR__ . '/domain/Cliente.php';
require __DIR__ . '/domain/TipoImovel.php';
require __DIR__ . '/domain/Grupo.php';
require __DIR__ . '/domain/Estado.php';
require __DIR__ . '/domain/Cidade.php';
require __DIR__ . '/domain/Bairro.php';
require __DIR__ . '/domain/TipoUsuario.php';
require __DIR__ . '/domain/Funcionalidade.php';
require __DIR__ . '/domain/AcaoFuncionalidade.php';
require __DIR__ . '/domain/Permissao.php';

/*
Middleware
*/
require __DIR__ . '/middleware/Middleware.php';
require __DIR__ . '/middleware/ValidationErrorsMiddleware.php';
require __DIR__ . '/middleware/OldMiddleware.php';
require __DIR__ . '/middleware/AuthorizationMiddleware.php';
require __DIR__ . '/middleware/PermissionMiddleware.php';





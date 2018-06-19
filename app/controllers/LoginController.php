<?php
namespace App\Controllers;

use App\Domain\Usuario;
use App\Exceptions\NotFoundException;
// use \Datetime;
use Respect\Validation\Validator as v;

class LoginController extends BaseController
{
    public function Index($request, $response)
    {
        unset($_SESSION['user']);
        return $this->view->render($response, 'login/login.twig');
    }

    public function Login($request, $response)
    {
        $validation = $this->validator->Validate($request, [
            'login' => v::notEmpty()->noWhitespace(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('login'));
        }

        try {

            $data = $request->getParsedBody();

            $user = Usuario::with('foto')->where('login', $data['login'])->where('ativo', 1)->first();

            if (!$user || !password_verify($data['password'], $user->senha)) {
                $this->container->flash->addMessage('message', 'Login ou senha invalidos!');
                return $response->withRedirect($this->router->pathFor('login'));
            } else {
                $_SESSION['user'] = ["id" => $user->id,
                    "nome" => $user->nome,
                    "urlwatermark" => $this->FotoController->GetUrlWaterMark(),
                    "urlfoto" => $user->foto && $user->foto->exists ? $user->foto->urlrelative : '',
                ];

                return $response->withRedirect($this->router->pathFor('home'));
            }

            throw new NotFoundException("Login ou senha invalidos!");
        } catch (Exception $e) {
        }
    }

    public function LogOut($request, $response)
    {
        unset($_SESSION['user']);
        return $response->withRedirect($this->router->pathFor('public'));
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public function getUserSession()
    {
        return $_SESSION['user'];
    }

    public function GetCurrentFoto()
    {

        $currentUserFoto = Usuario::with('foto')->find($_SESSION['user']['id']);

        if ($currentUserFoto && $currentUserFoto->foto) {
            if ($currentUserFoto->foto->exists) {
                return $currentUserFoto->foto->urlrelative;
            }
        }
        return "";
    }
}

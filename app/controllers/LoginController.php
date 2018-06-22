<?php
namespace App\Controllers;

use App\Domain\TipoUsuario;
// use \Datetime;
use App\Domain\Usuario;
use App\Domain\Funcionalidade;
use App\Exceptions\NotFoundException;
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

            $user = Usuario::with(['foto'])->where('login', $data['login'])->where('ativo', 1)->first();

            if (!$user || !password_verify($data['password'], $user->senha)) {
                $this->container->flash->addMessage('message', 'Login ou senha invalidos!');
                return $response->withRedirect($this->router->pathFor('login'));
            } else {

                $_SESSION['user'] = ["id" => $user->id,
                    "nome" => $user->nome,
                    "urlwatermark" => $this->FotoController->GetUrlWaterMark(),
                    "urlfoto" => $user->foto && $user->foto->exists ? $user->foto->urlrelative : '',
                    "tipousuario" => $user->tipousuario,
                ];

                $this->_getPermissoesUsuario($user);
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

    private function _getPermissoesUsuario($usuario)
    {
        // var_dump($usuario->tipousuario);
        // var_dump(\App\Domain\TipoUsuario::Supervisor);
        // var_dump($usuario->tipousuario <= \App\Domain\TipoUsuario::Supervisor);
        // var_dump($usuario->grupo_id);
        // die();
        if ($usuario->tipousuario <= \App\Domain\TipoUsuario::Supervisor) {
            
            //var_dump('passou aqui');
            //TODO: IF para identificar se o usuario possui permissao exclusiva
            if ($usuario->grupo_id ) {
                $permissoes = Funcionalidade::leftJoin('acaofuncionalidade as a', 'funcionalidade.id', 'a.funcionalidade_id')
                    ->leftJoin('permissao as p', 'a.id', 'p.acaofuncionalidade_id')
                    ->leftJoin('grupo as g', 'p.grupo_id', 'g.id')
                    ->whereRaw('g.id = ? or a.precisadepermissao = 0', [$usuario->grupo_id])
                    ->select('a.url', 'a.metodo')
                    ->get()->toArray();

                array_push($_SESSION['user'], "permissoes", $permissoes);

//                 foreach ($permissoes as $key => $value) {
//                     var_dump($key);
//                     var_dump($value->url);
//                     # code...
//                 }

// die();
                
                $_SESSION['user']['permissoes'] = $permissoes;

            } else {
                //TODO: Carregar Permissoes do Usuario
                return null;
            }
        } else {
            return null;
        }
    }
}

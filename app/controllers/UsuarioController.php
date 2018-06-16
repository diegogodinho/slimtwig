<?php

namespace App\Controllers;

use App\Domain\Foto;
use App\Domain\Usuario;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class UsuarioController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'usuario/index.twig');
    }

    public function _all($request, $response, $data)
    {
        $total = Usuario::count();
        $result = $this->Pagination(Usuario::select('id', 'nome', 'email', 'login', 'ativo'), (int) $data['start'], (int) $data['length'])->get();

        return $response->withJson([
            "data" => $result,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    }

    //Create
    public function CreateView($request, $response)
    {
        return $this->view->render($response, 'usuario/create.twig', ['DescricaoLabelBotaoUploadImagem' => 'Carregar foto']);
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email()->EmailValidator(),
            'nome' => v::notEmpty(),
            'login' => v::noWhitespace()->notEmpty()->LoginValidator(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('usuario.createview'));
        }

        Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => password_hash($data['password'], PASSWORD_DEFAULT),
            'login' => $data['login'],
            'foto_id' => (int) $data['foto_id'],
        ]);

        return $response->withRedirect($this->router->pathFor('usuario.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {
        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('usuario.indexview'));
        }

        $user = Usuario::with('foto')->find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $user->nome,
            'email' => $user->email,
            'login' => $user->login,
            'id' => $user->id,
            'urlrelative' => $user->foto && $user->foto->exists ? $user->foto->urlrelative : null,           
            'foto_id' => $user->foto->exists ? $user->foto->id : null,
        ];

        if (isset($_SESSION['unsaveddata'])) {
            $_SESSION['old']['urlrelative'] = $_SESSION['unsaveddata']['urlrelative'];
            $_SESSION['old']['foto_id'] = $_SESSION['unsaveddata']['foto_id'];
            unset($_SESSION['unsaveddata']);
        }

        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'usuario/create.twig', ['DescricaoLabelBotaoUploadImagem' => 'Carregar foto']);
    }

    public function _update($request, $response, $data, $user)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email(),
            'nome' => v::notEmpty(),
            'login' => v::noWhitespace()->notEmpty(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if (!$this->validator->Valid()) {

            $_SESSION['unsaveddata'] = ["foto_id" => $data['foto_id'],
                "urlrelative" => $data['urlrelative']];

            return $response->withRedirect($this->router->pathFor('usuario.editview', ["id" => $user->id]));
        }

        $user->email = $data['email'];
        $user->nome = $data['nome'];
        $user->login = $data['login'];
        $user->senha = password_hash($data['password'], PASSWORD_DEFAULT);
        $fotoChanged = false;
        $oldFotoID = 0;
        $newFotoUploaded = !empty($data['foto_id']);
        if ($newFotoUploaded) {
            $fotoChanged = $user->foto_id != $data['foto_id'];
            $oldFotoID = $user->foto_id;
            $user->foto_id = $data['foto_id'];
        }

        $user->save();

        if ($fotoChanged) {
            $this->FotoController->_DeleteImage($oldFotoID);
        }       
        return $response->withRedirect($this->router->pathFor('usuario.indexview'));
    }

    public function Delete($request, $response)
    {
    }

    public function ActivateDeactivate($request, $response)
    {
        $user = Usuario::find((int) $request->getAttribute('id'));
        $user->ativo = $user->ativo ? 0 : 1;
        $user->save();
        $response = $response->withStatus(200);
        return $response;
    }

    public function _find($id)
    {
        return Usuario::find($id);
    }

    public function GetCurrentFoto()
    {
        $currentUserFoto = Usuario::with('foto')->find($_SESSION['user']['id']);       
        if ($currentUserFoto->foto->exists) {
            return $currentUserFoto->foto->urlrelative;
        }
        return "";
    }
}

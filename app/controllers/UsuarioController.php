<?php

namespace App\Controllers;

use App\Domain\Usuario;
use Respect\Validation\Validator as v;
use App\Validation\Validator;

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
        return $this->view->render($response, 'usuario/create.twig',['foto' => ['urlrelative'=> '', 'DescricaoLabelBotaoUploadImagem' => 'Carregar Foto']]);
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email()->EmailValidator(),
            'name' => v::notEmpty(),
            'login' => v::noWhitespace()->notEmpty()->LoginValidator(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('usuario.createview'));
        }

        Usuario::create([
            'nome' => $data['name'],
            'email' => $data['email'],
            'senha' => password_hash($data['password'], PASSWORD_DEFAULT),
            'login' => $data['login'],
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

        $user = Usuario::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'name' => $user->nome,
            'email' => $user->email,
            'login' => $user->login,
            'id' => $user->id,
        ];
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'usuario/create.twig',['foto' => ['urlrelative'=> '', 'DescricaoLabelBotaoUploadImagem' => 'Carregar Foto']]);
    }

    public function _update($request, $response, $data, $user)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email(),
            'name' => v::notEmpty(),
            'login' => v::noWhitespace()->notEmpty(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('usuario.editview', ["id" => $user->id]));
        }

        $user->email = $data['email'];
        $user->nome = $data['name'];
        $user->login = $data['login'];
        $user->senha = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->save();

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
}

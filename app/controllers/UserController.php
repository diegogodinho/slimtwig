<?php

namespace App\Controllers;

use App\Domain\User;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class UserController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'user/index.twig');
    }

    public function _all($request, $response, $data)
    {
        $total = User::count();
        $result = $this->Pagination(User::select('id', 'name', 'email', 'login', 'active'), (int) $data['start'], (int) $data['length'])->get();

        return $response->withJson([
            "data" => $result,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    }

    //Create
    public function CreateView($request, $response)
    {
        return $this->view->render($response, 'user/create.twig');
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
            return $response->withRedirect($this->router->pathFor('user.createview'));
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'login' => $data['login'],
        ]);

        return $response->withRedirect($this->router->pathFor('user.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('user.indexview'));
        }

        $user = User::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'name' => $user->name,
            'email' => $user->email,
            'login' => $user->login,
            'id' => $user->id,
        ];
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'user/create.twig');
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
            return $response->withRedirect($this->router->pathFor('user.editview', ["id" => $user->id]));
        }

        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->save();

        return $response->withRedirect($this->router->pathFor('user.indexview'));
    }

    public function Delete($request, $response)
    {
    }

    public function ActivateDeactivate($request, $response)
    {
        $user = User::find((int) $request->getAttribute('id'));
        $user->active = $user->active ? 0 : 1;
		$user->save();
		$response = $response->withStatus(200);
		return $response;
    }

    public function _find($id)
    {
        return User::find($id);
    }
}

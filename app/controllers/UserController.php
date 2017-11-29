<?php

namespace App\Controllers;

use App\Domain\User;
use App\Exceptions\NotFoundException;
use App\Validation\Validator;
use Respect\Validation\Validator as v;
use App\Validation\Validator\CustomValidator;

use Exception;

class UserController extends CRUDController {
	
	public function Index($request, $response)
	{
		return $this->view->render($response, 'user/user.list.twig');
	}

	public function SignUp($request, $response)
	{
		return $this->view->render($response, 'user/signUp.twig');
	}
	
	public function Edit($request, $response)
	{
		$validation = $this->validator->Validate($request,[
			'id'=> v::intVal()->positive()
		]);

		if (!$this->validator->Valid())
		{			
			return $response->withRedirect($this->router->pathFor('user/user.list.twig'));
		}	

		$user = User::find((int)$request->getAttribute('id'));

		$_SESSION['old'] = [
			'name' => $user->name,
			'email' => $user->email,
			'login' => $user->login,
			'id' => $user->id
		];	
		$this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old']: null);

		return $this->view->render($response, 'user/signUp.twig');
	}

	public function _all($request, $response, $data)
	{
		$total = User::count();
		$result = $this->Pagination(User::select('id','name','email','login'), (int)$data['start'], (int)$data['length'])->get();
		
		return $response->withJson([
			"data" => $result,
			"recordsTotal" => $total,
			"recordsFiltered"=> $total,			
		]);
	}

	public function _update($request, $response, $data, $user)
	{
		$validation = $this->validator->Validate($request,[
			'email'=> v::notEmpty()->noWhitespace()->email(),
			'name'=> v::notEmpty(),
			'login' =>v::noWhitespace()->notEmpty(),
			'password'=> v::noWhitespace()->notEmpty()
		]);
		
		if (!$this->validator->Valid())
		{
			return $this->view->render($response, 'user/signUp.twig');
		}			

		$user->email = $data['email'];
		$user->name = $data['name'];
		$user->login = $data['login'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->save();		

		return $response->withRedirect($this->router->pathFor('user.index'));
	}

	public function _getByID($request, $response, $id)
	{
		$result = User::select('id','name','email','login')->find($id);
		if ($result == null)
		{
			throw new NotFoundException();	
		}			
		return $response->withJson($result);
	}

	public function _create($request, $response, $data)
	{		
		$validation = $this->validator->Validate($request,[
			'email'=> v::notEmpty()->noWhitespace()->email()->EmailValidator(),
			'name'=> v::notEmpty(),
			'login' =>v::noWhitespace()->notEmpty()->LoginValidator(),
			'password'=> v::noWhitespace()->notEmpty()
		]);
		
		if (!$this->validator->Valid())
		{
			return $response->withRedirect($this->router->pathFor('signup'));
		}

		User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'login' => $data['login']
		]);

		return $response->withRedirect($this->router->pathFor('user.index'));
	}

	public function _find($id)
	{
		return User::find($id);
	}
}	
?>
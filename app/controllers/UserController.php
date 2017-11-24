<?php

namespace App\Controllers;

use App\Domain\User;
use App\Exceptions\NotFoundException;
use App\Validation\Validator;
use Respect\Validation\Validator as v;
use App\Validation\Validator\CustomValidator;

use Exception;

class UserController extends CRUDController {
	
	public function SignUp($request, $response)
	{
		return $this->view->render($response, 'user/signUp.twig');
	}

	public function _all($request, $response, $data)
	{
		$total = User::count();
		$page = (int)$request->getAttribute('page');			
		$result = $this->DoPagination(User::select('id','name','email','login'), $page)->get();

		return $response->withJson([
			"data"=>$result,
			"total"=>$total
		]);
	}

	public function _update($request, $response, $data, $user)
	{
		$validation = $this->validator->Validate($request,[
			'email'=> v::notEmpty()->noWhitespace()->email(),
			'name'=> v::noWhitespace()->notEmpty(),
			'login' =>v::noWhitespace()->notEmpty(),
			'password'=> v::noWhitespace()->notEmpty()
		]);
		
		if (!$this->validator->Valid())
		{
			$response = $response->withStatus(400)->withJson($this->validator->GetJsonMessages());
			return $response;
		}			

		$user->email = $data['email'];
		$user->name = $data['name'];
		$user->login = $data['login'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->save();		

		return $response->withStatus(201);		
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
			'name'=> v::noWhitespace()->notEmpty(),
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

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function _find($id)
	{
		return User::find($id);
	}
}	
?>
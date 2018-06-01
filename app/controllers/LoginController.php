<?php
namespace App\Controllers;

use App\Domain\User;
use Respect\Validation\Validator as v;
// use \Datetime;
use App\Exceptions\NotFoundException;
use \DateInterval;

class LoginController extends BaseController
{
    public function Index($request, $response)
    {
        return $this->view->render($response, 'login/login.twig');
    }

    public function Login($request, $response)
    {
        $validation = $this->validator->Validate($request,[
			'login'=> v::notEmpty()->noWhitespace(),
			'password'=> v::noWhitespace()->notEmpty()
        ]);
        
        if (!$this->validator->Valid())
		{
			// $response = $response->withStatus(400)->withJson($this->validator->GetJsonMessages());
            //return $response;
            return $response->withRedirect($this->router->pathFor('login'));
        }
        
        try	{
			
			$data = $request->getParsedBody();				
            
            $user = User::where('login', $data['login'])->first();

            if (!$user || !password_verify($data['password'],$user->password))
            {
                $this->container->flash->addMessage('message','Login or Password invalid!');
                return $response->withRedirect($this->router->pathFor('login'));                
            }
            else
            {
                $_SESSION['user'] = ["id" => $user->id, "name" => $user->name];

                return $response->withRedirect($this->router->pathFor('home'));
            }           

            throw new NotFoundException("Login or Password invalid!");
        }        
		catch(Exception $e)
		{
			
		}
    }

    public function LogOut($request, $response)
    {
        unset($_SESSION['user']);
        return $response->withRedirect($this->router->pathFor('login'));
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public function getUserSession()
    {
        return $_SESSION['user'];
    }
}

<?php
namespace App\Controllers;

use App\Domain\User;
// use Respect\Validation\Validator as v;
// use \Datetime;
use App\Exceptions\NotFoundException;
use \DateInterval;

class LoginController extends BaseController
{
    public function Index($request, $response)
    {
        return $this->view->render($response, 'login/login.twig');
    }

    // public function Login($request, $response)
    // {
    //     // $validation = $this->validator->Validate($request,[
	// 	// 	'login'=> v::notEmpty()->noWhitespace(),
	// 	// 	'password'=> v::noWhitespace()->notEmpty()
    //     // ]);
        
    //     // if (!$this->validator->Valid())
	// 	// {
	// 	// 	// $response = $response->withStatus(400)->withJson($this->validator->GetJsonMessages());
	// 	// 	return $response;
    //     // }
        
    //     try	{
			
	// 		$data = $request->getParsedBody();				
            
    //         $user = User::where('login', $data['login'])->first();
            
            
    //         if(!$user)
    //         {                
    //             throw new NotFoundException("Login or Password invalid!");
    //         }

    //         if (password_verify($data['password'],$user->password))
    //         {
    //             // $now = new DateTime();                
    //             // $future = new DateTime();                
    //             // $future->add(new DateInterval('PT4H'));               
                
    //             // $secret = "your_secret_key";
                
    //             // $payload = [                    
    //             //     "iat" => $now->getTimeStamp(),
    //             //     "nbf" => $now->getTimeStamp(),
    //             //     "exp" => $future->getTimeStamp(),
    //             //     "user"=> [
    //             //         "id" => $user->id,
    //             //         "name"=> $user->name
    //             //     ]
    //             // ];
                
    //             // $token = JWT::encode($payload, $secret);
    //             // // $response = $response->withJson($token);
    //             // $response = $response->withJson(["token" => $token,
    //             //                                 "user"=>[
    //             //                                     "name"=> $user->name,
    //             //                                     "email"=> $user->email
    //             //                                     ]
    //             //                                 ]);
    //             return $response;
    //         }
    //         throw new NotFoundException("Login or Password invalid!");
    //     }        
    //     catch(NotFoundException $e){			
	// 	}
	// 	catch(Exception $e)
	// 	{
			
	// 	}
    // }
}

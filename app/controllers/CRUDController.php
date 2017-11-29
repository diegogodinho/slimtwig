<?php

namespace App\Controllers;
use Respect\Validation\Validator as v;
use Exception;
use App\Validation\Validator;
use App\Domain\ErrorJson;

abstract class CRUDController extends BaseController
{    
    abstract public function _all($request, $response, $data);
    abstract public function _update($request, $response, $data, $entity);    
    abstract public function _create($request, $response, $data);
    abstract public function _find($id);    

    public function All($request, $response) 
    {       

        try {           

            $data = $request->getParsedBody();

            return $this->_all($request, $response, $data);
        }
        catch(Exception $e)
        {            
            $response = $response->withStatus(400)->withJson(array(new ErrorJson($e->getMessage())));
            return $response;
        }

    }
    
    public function Update($request, $response)
    {
        try { 
            
            $validation = $this->validator->Validate($request, [
                'id'=> v::intVal()->numeric()->positive()
            ]);

            if (!$this->validator->Valid())
            {
                $response = $response->withStatus(400)->withJson($this->validator->GetJsonMessages());
                return $response;
            }
            
            $id = (int)$request->getAttribute('id');
            $data = $request->getParsedBody();            

            $entity = $this->_find($id);

            if ($entity == null)
			{
				throw new Exception("ID not found");
            }
            
            return $this->_update($request, $response, $data, $entity);
        }
        catch(Exception $e)
        {            
            $response = $response->withStatus(400)->withJson(array(new ErrorJson($e->getMessage())));
            return $response;
        }        
    }

    public function Delete($request, $response)
    {
        try {   
            $data = $request->getParsedBody();           
            
            $validation = $this->validator->Validate($request, [
                'id'=> v::intVal()->numeric()->positive()
            ]);
            
            if (!$this->validator->Valid())
            {
                $response = $response->withStatus(400)->withJson($this->validator->GetJsonMessages());
                return $response;
            }
            $id = (int)$request->getAttribute('id');           

            $result = $this->_find($id);
            
            if (!$result)
            {
                throw new Exception("Record not found");
            }
            $result->delete();
            
            return $response->withStatus(200);
        }       
        catch(Exception $e)
        {            
            $response = $response->withStatus(400)->withJson(array(new ErrorJson($e->getMessage())));
            return $response;
        }          
        
    }
    
    public function Create($request, $response)
    {
        try
        {
            $data = $request->getParsedBody();
            return $this->_create($request, $response, $data);
        }
        catch(Exception $e)
        {
            $response = $response->withStatus(400)->withJson(array(new ErrorJson($e->getMessage())));
			return $response;
        }
    }
}

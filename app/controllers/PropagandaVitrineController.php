<?php
namespace App\Controllers;

class PropagandaVitrineController extends CRUDController
{   

    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'propagandavitrine/index.twig');
    }

    public function _all($request, $response, $data)
    {
        $query = PropagandaVitrine::select('id', 'nome');
        $data = $request->getParsedBody();
        
        $total = $query->count();

        $result = $this->Pagination($query->orderby('id', 'desc'), (int) $data['start'], (int) $data['length'])->get();

        return $response->withJson([
            "data" => $result,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    }

    //Create
    public function CreateView($request, $response)
    {   
        if (isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = $_SESSION['unsaveddata'];
        }

        return $this->view->render($response, 'propagandavitrine/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'urlfoto1' => v::notEmpty(),
            'urlfoto2' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            $this->SetUnsavedData($data);
            return $response->withRedirect($this->router->pathFor('propagandavitrine.createview'));
        }

        PropagandaVitrine::create([
            'nome' => $data['nome'],            
        ]);

        return $response->withRedirect($this->router->pathFor('propagandavitrine.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {        

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('propagandavitrine.indexview'));
        }

        $propagandavitrine = PropagandaVitrine::find((int) $request->getAttribute('id'));      

        if (!isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = [
                'nome' => $propagandavitrine->nome,                
                'urlfoto1' =>$propagandavitrine->urlfoto1,
                'urlfoto2' =>$propagandavitrine->urlfoto2,
            ];
        } else {
            $_SESSION['old'] = $_SESSION['unsaveddata'];
            unset($_SESSION['unsaveddata']);
        }
       
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'propagandavitrine/create.twig');
    }

    public function _update($request, $response, $data, $propagandavitrine)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'urlfoto1' => v::notEmpty(),
            'urlfoto2' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('propagandavitrine.editview', ["id" => $propagandavitrine->id]));
        }

        $propagandavitrine->nome = $data['nome'];
        $propagandavitrine->urlfoto1 = $data['urlfoto1'];
        $propagandavitrine->urlfoto2 = $data['urlfoto2'];        
        $propagandavitrine->save();
        return $response->withRedirect($this->router->pathFor('propagandavitrine.indexview'));
    }

    public function _find($id)
    {
        return PropagandaVitrine::find($id);
    }

    public function Delete($request, $response)
    {

    }    
}

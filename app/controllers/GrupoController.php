<?php

namespace App\Controllers;

use App\Domain\Grupo;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class GrupoController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'grupo/index.twig');
    }

    public function _all($request, $response, $data)
    {

        $query = Grupo::select('id', 'nome');
        $data = $request->getParsedBody();
       
        if ($data) {
            if (!empty($data['nome'])) {
                $query = $query->where('nome', 'like', '%' . $data['nome'] . '%');
            }                  
        }
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
        return $this->view->render($response, 'grupo/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('grupo.createview'));
        }

        Grupo::create([
            'nome' => $data['nome']
        ]);

        return $response->withRedirect($this->router->pathFor('grupo.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('grupo.indexview'));
        }

        $grupo = grupo::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $grupo->nome,
            'id' => $grupo->id
        ];
        
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'grupo/create.twig');
    }

    public function _update($request, $response, $data, $grupo)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('grupo.editview', ["id" => $grupo->id]));
        }

        $grupo->nome = $data['nome'];        
        $grupo->save();
        return $response->withRedirect($this->router->pathFor('grupo.indexview'));
    }

    public function _find($id)
    {
        return grupo::find($id);
    }

    public function Delete($request, $response)
    {

    }
}

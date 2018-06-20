<?php

namespace App\Controllers;

use App\Domain\Estado;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class EstadoController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'estado/index.twig');
    }

    public function _all($request, $response, $data)
    {

        $query = Estado::select('id', 'nome','sigla');
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
        return $this->view->render($response, 'estado/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'sigla' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('estado.createview'));
        }

        Estado::create([
            'nome' => $data['nome'],
            'sigla' => $data['sigla'],
        ]);

        return $response->withRedirect($this->router->pathFor('estado.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('estado.indexview'));
        }

        $Estado = Estado::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $Estado->nome,
            'id' => $Estado->id,
            'sigla' => $Estado->sigla
        ];
        
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'estado/create.twig');
    }

    public function _update($request, $response, $data, $Estado)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'sigla' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('estado.editview', ["id" => $Estado->id]));
        }

        $Estado->nome = $data['nome'];        
        $Estado->sigla = $data['sigla'];        
        $Estado->save();
        return $response->withRedirect($this->router->pathFor('sigla.indexview'));
    }

    public function _find($id)
    {
        return Estado::find($id);
    }

    public function Delete($request, $response)
    {

    }
}

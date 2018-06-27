<?php

namespace App\Controllers;

use App\Domain\Construtora;

class ConstrutoraController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'construtora/index.twig');
    }

    public function _all($request, $response, $data)
    {

        $query = Construtora::select('id', 'nome','sigla');
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
        return $this->view->render($response, 'construtora/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'sigla' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('construtora.createview'));
        }

        construtora::create([
            'nome' => $data['nome'],
            'sigla' => $data['sigla'],
        ]);

        return $response->withRedirect($this->router->pathFor('construtora.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('construtora.indexview'));
        }

        $construtora = construtora::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $construtora->nome,
            'id' => $construtora->id,
            'sigla' => $construtora->sigla
        ];
        
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'construtora/create.twig');
    }

    public function _update($request, $response, $data, $construtora)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'sigla' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('construtora.editview', ["id" => $construtora->id]));
        }

        $construtora->nome = $data['nome'];        
        $construtora->sigla = $data['sigla'];        
        $construtora->save();
        return $response->withRedirect($this->router->pathFor('sigla.indexview'));
    }

    public function _find($id)
    {
        return construtora::find($id);
    }

    public function Delete($request, $response)
    {

    }
}

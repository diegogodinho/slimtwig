<?php

namespace App\Controllers;

use App\Domain\Regiao;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class RegiaoController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'regiao/index.twig');
    }
    public function _all($request, $response, $data)
    {
        $query = Regiao::select('id', 'nome', 'ativo');
        $data = $request->getParsedBody();
        if ($data) {
            if (!empty($data['nome'])) {
                $query = $query->where('nome', 'like', '%' . $data['nome'] . '%');
            }
            if ($data['ativo'] == '0' ||  $data['ativo'] == '1') {
                $query = $query->where('ativo', (int)$data['ativo']);
            }            
        }

        $total = $query->count();

        $result = $this->Pagination($query->orderby('id','desc'), (int) $data['start'], (int) $data['length'])->get();

        return $response->withJson([
            "data" => $result,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    }

    //Create
    public function CreateView($request, $response)
    {
        return $this->view->render($response, 'regiao/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('regiao.createview'));
        }

        Regiao::create([
            'nome' => $data['nome'],
        ]);

        return $response->withRedirect($this->router->pathFor('regiao.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('regiao.indexview'));
        }

        $regiao = Regiao::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $regiao->nome,
            'id' => $regiao->id,
        ];
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'regiao/create.twig');
    }

    public function _update($request, $response, $data, $regiao)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('regiao.editview', ["id" => $regiao->id]));
        }

        $regiao->nome = $data['nome'];
        $regiao->save();
        return $response->withRedirect($this->router->pathFor('regiao.indexview'));
    }  
    
    public function _find($id)
    {
        return Regiao::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $regiao = Regiao::find((int) $request->getAttribute('id'));
        $regiao->ativo = $regiao->ativo ? 0 : 1;
        $regiao->save();
        $response = $response->withStatus(200);
        return $response;
    }
    
}

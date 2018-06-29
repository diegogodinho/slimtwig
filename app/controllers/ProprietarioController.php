<?php

namespace App\Controllers;

use App\Domain\Proprietario;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class ProprietarioController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'proprietario/index.twig');
    }
    public function _all($request, $response, $data)
    {
        $query = Proprietario::select('id', 'nome', 'ativo');
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
        return $this->view->render($response, 'proprietario/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('proprietario.createview'));
        }

        Proprietario::create([
            'nome' => $data['nome'],
        ]);

        return $response->withRedirect($this->router->pathFor('proprietario.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('proprietario.indexview'));
        }

        $proprietario = Proprietario::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $proprietario->nome,
            'id' => $proprietario->id,
        ];
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'proprietario/create.twig');
    }

    public function _update($request, $response, $data, $proprietario)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('proprietario.editview', ["id" => $proprietario->id]));
        }

        $proprietario->nome = $data['nome'];
        $proprietario->save();
        return $response->withRedirect($this->router->pathFor('proprietario.indexview'));
    }  
    
    public function _find($id)
    {
        return Proprietario::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $proprietario = Proprietario::find((int) $request->getAttribute('id'));
        $proprietario->ativo = $proprietario->ativo ? 0 : 1;
        $proprietario->save();
        $response = $response->withStatus(200);
        return $response;
    }
    
}

<?php

namespace App\Controllers;

use App\Domain\TipoImovel;
use App\Validation\Validator;
use Respect\Validation\Validator as v;


class TipoImovelController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'tipoimovel/index.twig');
    }
    public function _all($request, $response, $data)
    {
        $query = TipoImovel::select('id', 'nome', 'ativo');
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
        return $this->view->render($response, 'tipoimovel/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('tipoimovel.createview'));
        }

        TipoImovel::create([
            'nome' => $data['nome'],
        ]);

        return $response->withRedirect($this->router->pathFor('tipoimovel.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('tipoimovel.indexview'));
        }

        $tipoimovel = TipoImovel::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $tipoimovel->nome,
            'id' => $tipoimovel->id,
        ];
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'tipoimovel/create.twig');
    }

    public function _update($request, $response, $data, $tipoimovel)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('tipoimovel.editview', ["id" => $tipoimovel->id]));
        }

        $tipoimovel->nome = $data['nome'];
        $tipoimovel->save();
        return $response->withRedirect($this->router->pathFor('tipoimovel.indexview'));
    }  
    
    public function _find($id)
    {
        return TipoImovel::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $tipoImovel = TipoImovel::find((int) $request->getAttribute('id'));
        $tipoImovel->ativo = $tipoImovel->ativo ? 0 : 1;
        $tipoImovel->save();
        $response = $response->withStatus(200);
        return $response;
    }
    
}

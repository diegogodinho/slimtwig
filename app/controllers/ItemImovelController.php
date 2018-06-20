<?php

namespace App\Controllers;

use App\Domain\ItemImovel;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class ItemImovelController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'itemimovel/index.twig');
    }

    public function _all($request, $response, $data)
    {

        $query = ItemImovel::select('id', 'nome', 'ativo', 'possuiqtde');
        $data = $request->getParsedBody();
       
        if ($data) {
            if (!empty($data['nome'])) {
                $query = $query->where('nome', 'like', '%' . $data['nome'] . '%');
            }
            if (($data['ativo'] == '0' || $data['ativo'] == '1')) {               
                $query = $query->where('ativo', (int) $data['ativo']);
            }
            if ($data["itenscomquantidade"] == '1') {
                $query = $query->where('possuiqtde', 1);
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
        return $this->view->render($response, 'itemimovel/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('itemimovel.createview'));
        }

        ItemImovel::create([
            'nome' => $data['nome'],
            'possuiqtde' => (!empty($data['possuiqtde']) && $data['possuiqtde'] > 0) ? 1 : 0
        ]);

        return $response->withRedirect($this->router->pathFor('itemimovel.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('itemimovel.indexview'));
        }

        $itemimovel = ItemImovel::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $itemimovel->nome,
            'id' => $itemimovel->id,
            'possuiqtde' => $itemimovel->possuiqtde
        ];
        
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'itemimovel/create.twig');
    }

    public function _update($request, $response, $data, $itemimovel)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('itemimovel.editview', ["id" => $itemimovel->id]));
        }

        $itemimovel->nome = $data['nome'];
        $itemimovel->possuiqtde  = (!empty($data['possuiqtde']) && $data['possuiqtde'] > 0) ? 1 : 0;      
        $itemimovel->save();
        return $response->withRedirect($this->router->pathFor('itemimovel.indexview'));
    }

    public function _find($id)
    {
        return ItemImovel::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $itemimovel = ItemImovel::find((int) $request->getAttribute('id'));
        $itemimovel->ativo = $itemimovel->ativo ? 0 : 1;
        $itemimovel->save();
        $response = $response->withStatus(200);
        return $response;
    }

}

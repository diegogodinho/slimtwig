<?php

namespace App\Controllers;

use App\Domain\Midia;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class MidiaController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {       
        return $this->view->render($response, 'midia/index.twig');
    }

    public function _all($request, $response, $data)
    {
        $query = Midia::select('id', 'nome', 'ativo');
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
        return $this->view->render($response, 'midia/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('midia.createview'));
        }

        Midia::create([
            'nome' => $data['nome']
        ]);

        return $response->withRedirect($this->router->pathFor('midia.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('midia.indexview'));
        }

        $midia = Midia::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $midia->nome,
            'id' => $midia->id
        ];
        
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'midia/create.twig');
    }

    public function _update($request, $response, $data, $midia)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('midia.editview', ["id" => $midia->id]));
        }

        $midia->nome = $data['nome'];          
        $midia->save();
        return $response->withRedirect($this->router->pathFor('midia.indexview'));
    }

    public function _find($id)
    {
        return Midia::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $midia = Midia::find((int) $request->getAttribute('id'));
        $midia->ativo = $midia->ativo ? 0 : 1;
        $midia->save();
        $response = $response->withStatus(200);
        return $response;
    }

}

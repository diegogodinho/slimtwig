<?php

namespace App\Controllers;

use App\Domain\Cidade;
use App\Domain\Estado;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class CidadeController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        $estados = Estado::all();
        return $this->view->render($response, 'cidade/index.twig', ["estados" => $estados]);
    }

    public function _all($request, $response, $data)
    {
        $query = Cidade::with('estado:id,nome');

        $data = $request->getParsedBody();

        if ($data) {
            if (!empty($data['nome'])) {
                $query = $query->where('nome', 'like', '%' . $data['nome'] . '%');
            }
            if (!empty($data['estado_id'])) {
                $query = $query->where('estado_id', '=', $data['estado_id']);
            }
        }
        $total = $query->count();
        // var_dump($query);
        // die();

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
        $estados = Estado::all();
        return $this->view->render($response, 'cidade/create.twig', ["estados" => $estados]);
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'estado' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('cidade.createview'));
        }
        // var_dump($data['estado']);
        // die();

        Cidade::create([
            'nome' => $data['nome'],
            'estado_id' => $data['estado'],
        ]);

        return $response->withRedirect($this->router->pathFor('cidade.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('cidade.indexview'));
        }

        $cidade = cidade::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'nome' => $cidade->nome,
            'id' => $cidade->id,
            'estado' => $cidade->estado_id,
        ];
        $estados = Estado::all();

        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'cidade/create.twig', ["estados" => $estados]);
    }

    public function _update($request, $response, $data, $cidade)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'estado' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('cidade.editview', ["id" => $cidade->id]));
        }

        $cidade->nome = $data['nome'];
        $cidade->estado_id = $data['estado'];
        $cidade->save();
        return $response->withRedirect($this->router->pathFor('cidade.indexview'));
    }

    public function _find($id)
    {
        return Cidade::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function GetCidadeDropDownPorEstado($request, $response)
    {
        $data = $request->getParsedBody();        

        if ($this->IsItInArray('estado_id',$data) && $this->IsItInArray('dropdownid',$data) && $this->IsItInArray('dropdownname',$data)) {            
            $lista = Cidade::where('estado_id', $data['estado_id'])->select(['id','nome'])->get();
            // var_dump($lista);
            // die();



            return $this->view->render($response, 'templates/dropdown.twig', ["id_dropdown"=> $data["dropdownid"],
            "name_dropdown"=> $data["dropdownname"],  "lista" => $lista]);
        }
        return $response->withStatus(404)->withJson(['Mensagem' => 'estado_id, dropdownid e dropdownname devem ser informados!']);
    }
}

<?php

namespace App\Controllers;

use App\Domain\Bairro;
use App\Domain\Estado;
use App\Domain\Cidade;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class BairroController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        $estados = Estado::all();        
        return $this->view->render($response, 'bairro/index.twig', ["estados" => $estados]);
    }

    public function _all($request, $response, $data)
    {
        $query = Bairro::with('cidade.estado');

        if ($data) {
            if (!empty($data['nome'])) {                
                $query = $query->where('nome', 'like', '%' . $data['nome'] . '%');
            }
            if (!empty($data['estado_id'])) {                         
                $query = $query->wherehas('cidade.estado', function ($q) use ($data) {
                    $q->where('id', '=', $data['estado_id']);
                });
            }
            if (!empty($data['cidade_id'])) {                
                $query = $query->where('cidade_id', '=', $data['cidade_id']);
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
        $estados = Estado::all();
        $cidades = [];
        if (isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = $_SESSION['unsaveddata'];

            if ($this->IsItInArray('estado', $_SESSION['old'])) {
                $cidades = Cidade::where('estado_id', $_SESSION['old']['estado'])->get();
            }

            unset($_SESSION['unsaveddata']);            
        }

        return $this->view->render($response, 'bairro/create.twig', ["estados" => $estados,'cidades'=> $cidades]);
    }

    public function _create($request, $response, $data)
    {        
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),            
            'cidade' => v::notEmpty(),
            'estado' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            $this->SetUnsavedData($data);
            return $response->withRedirect($this->router->pathFor('bairro.createview'));
        }

        Bairro::create([
            'nome' => $data['nome'],
            'cidade_id' => $data['cidade'],
        ]);

        return $response->withRedirect($this->router->pathFor('bairro.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('Bairro.indexview'));
        }

        $bairro = Bairro::with('cidade')->find((int) $request->getAttribute('id'));
        $cidades = [];

        if (!isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = [
                'nome' => $bairro->nome,
                'id' => $bairro->id,
                'cidade' => $bairro->cidade_id,
                'estado' => $bairro->cidade->estado_id
            ];
        } else {
            $_SESSION['old'] = $_SESSION['unsaveddata'];           
            unset($_SESSION['unsaveddata']);
        }
        
        if ($this->IsItInArray('estado', $_SESSION['old'])) {            
            $cidades = Cidade::where('estado_id', $_SESSION['old']['estado'])->get();
        }
        $estados = Estado::all();

        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'bairro/create.twig', ["estados" => $estados, 'cidades' => $cidades]);
    }

    public function _update($request, $response, $data, $Bairro)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
            'estado' => v::notEmpty(),
            'cidade' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            $this->SetUnsavedData($data);
            return $response->withRedirect($this->router->pathFor('bairro.editview', ["id" => $Bairro->id]));
        }

        $Bairro->nome = $data['nome'];
        $Bairro->cidade_id = $data['cidade'];
        $Bairro->save();
        return $response->withRedirect($this->router->pathFor('bairro.indexview'));
    }

    public function _find($id)
    {
        return Bairro::find($id);
    }

    public function Delete($request, $response)
    {

    }
}

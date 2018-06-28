<?php

namespace App\Controllers;

use App\Domain\Bairro;
use App\Domain\Cidade;
use App\Domain\Construtora;
use App\Domain\Estado;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class ConstrutoraController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'construtora/index.twig');
    }

    public function _all($request, $response, $data)
    {
        $query = Construtora::select('id', 'nome','telefone','ativo');
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
        $estados = Estado::all();
        $cidades = [];
        $bairros = [];

        if (isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = $_SESSION['unsaveddata'];

            if ($this->IsItInArray('estado', $_SESSION['old'])) {
                $cidades = Cidade::where('estado_id', $_SESSION['old']['estado'])->get();
            }
            if ($this->IsItInArray('cidade', $_SESSION['old'])) {
                $bairros = Bairro::where('cidade_id', $_SESSION['old']['cidade'])->get();
            }
            unset($_SESSION['unsaveddata']);
        }

        return $this->view->render($response, 'construtora/create.twig', [
            'estados' => $estados,
            'cidades' => $cidades,
            'bairros' => $bairros]);
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            $this->SetUnsavedData($data);
            return $response->withRedirect($this->router->pathFor('construtora.createview'));
        }

        Construtora::create([
            'nome' => $data['nome'],
            'bairro_id' => $this->IsItInArray('bairro', $data) ? $data['bairro'] : null,
            'endereco' => $data['endereco'],
            'complemento' => $data['complemento'],
            'telefone' => $data['telefone'],
            'telefonecel' => $data['telefonecel'],
            'observacoes' => $data['observacoes'],
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

        $construtora = construtora::with(['bairro.cidade.estado'])->find((int) $request->getAttribute('id'));
        $estados = Estado::all();
        $cidades = [];
        $bairros = [];
        $existeBairro = $construtora->bairro && $construtora->bairro->exists;

        if (!isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = [
                'nome' => $construtora->nome,
                'id' => $construtora->id,
                'endereco' =>$construtora->endereco,
                'complemento' =>$construtora->complemento,
                'bairro' => $existeBairro ? $construtora->bairro->id : null,
                'cidade' => $existeBairro ? $construtora->bairro->cidade->id : null,
                'estado' => $existeBairro ? $construtora->bairro->cidade->estado_id : null,
                'telefone' =>$construtora->telefone,
                'telefonecel' =>$construtora->telefonecel,
                'observacoes' =>$construtora->observacoes,
            ];
        } else {
            $_SESSION['old'] = $_SESSION['unsaveddata'];
            unset($_SESSION['unsaveddata']);
        }

        if ($this->IsItInArray('estado', $_SESSION['old'])) {
            $cidades = Cidade::where('estado_id', $_SESSION['old']['estado'])->get();
        }
        if ($this->IsItInArray('cidade', $_SESSION['old'])) {
            $bairros = Bairro::where('cidade_id', $_SESSION['old']['cidade'])->get();
        }

        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'construtora/create.twig',[
            'estados' => $estados,
            'cidades' => $cidades,
            'bairros' => $bairros,
        ]);
    }

    public function _update($request, $response, $data, $construtora)
    {
        $validation = $this->validator->Validate($request, [
            'nome' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('construtora.editview', ["id" => $construtora->id]));
        }

        $construtora->nome = $data['nome'];
        $construtora->bairro_id = $data['bairro'];
        $construtora->endereco = $data['endereco'];
        $construtora->complemento = $data['complemento'];
        $construtora->telefone = $data['telefone'];
        $construtora->telefonecel = $data['telefonecel'];
        $construtora->observacoes = $data['observacoes'];
        $construtora->save();
        return $response->withRedirect($this->router->pathFor('construtora.indexview'));
    }

    public function _find($id)
    {
        return construtora::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $construtora = Construtora::find((int) $request->getAttribute('id'));
        $construtora->ativo = $construtora->ativo ? 0 : 1;
        $construtora->save();
        $response = $response->withStatus(200);
        return $response;
    }
}

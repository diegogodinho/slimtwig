<?php

namespace App\Controllers;

use App\Domain\Cliente;

class ClienteController extends CRUDController
{

    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'cliente/index.twig');
    }

    public function _all($request, $response, $data)
    {

        $query = Cliente::select('id', 'nome', 'ativo', 'email', 'tipopessoa');
        $data = $request->getParsedBody();
        if ($data) {
            if (!empty($data['nome'])) {
                $query = $query->where('nome', 'like', '%' . $data['nome'] . '%');
            }
            if (!empty($data['email'])) {
                $query = $query->where('email', 'like', '%' . $data['email'] . '%');
            }
            if ($data['ativo'] == '0' || $data['ativo'] == '1') {
                $query = $query->where('active', (int) $data['active']);
            }
            if (!empty($data['telefonecel'])) {
                $query = $query->where('telefonecel', 'like', '%' . $data['telefonecel'] . '%');
            }
            if (!empty($data['tipopessoa'])) {
                if ($data['tipopessoa'] === "1") {
                    $query = $query->where('cpf', 'like', '%' . $data['cpf'] . '%');
                } else if ($data['tipopessoa'] === "0") {
                    $query = $query->where('cnpj', 'like', '%' . $data['cnpj'] . '%');
                }
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

    public function _update($request, $response, $data, $entity)
    {

    }
    public function _create($request, $response, $data)
    {

    }

    public function _find($id)
    {

    }
}

<?php

namespace App\Controllers;

use App\Domain\Foto;
use App\Domain\Grupo;
use App\Domain\Usuario;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class UsuarioController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'usuario/index.twig');
    }

    public function _all($request, $response, $data)
    {
        $total = Usuario::count();
        $result = $this->Pagination(Usuario::select('id', 'nome', 'email', 'login', 'ativo'), (int) $data['start'], (int) $data['length'])->get();

        return $response->withJson([
            "data" => $result,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    }

    //Create
    public function CreateView($request, $response)
    {
        $grupos = Grupo::all();
        return $this->view->render($response, 'usuario/create.twig', ['DescricaoLabelBotaoUploadImagem' => 'Carregar foto', 'grupos' => $grupos]);
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email()->EmailValidator(),
            'nome' => v::notEmpty(),
            'login' => v::noWhitespace()->notEmpty()->LoginValidator(),
            'senha' => v::noWhitespace()->notEmpty(),
            'identidade' => v::noWhitespace()->notEmpty(),
            'cpf' => v::noWhitespace()->notEmpty(),
            'datanascimento' => v::optional(v::date('yyyymmdd')),
            'dataadmissao' => v::optional(v::date('yyyymmdd')),
            'datademissao' => v::optional(v::date('yyyymmdd')),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('usuario.createview'));
        }

        Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => password_hash($data['senha'], PASSWORD_DEFAULT),
            'login' => $data['login'],
            'foto_id' => (int) $data['foto_id'],
            'grupo_id' => in_array("grupo", $data) ? $data['grupo'] : null,
            'cpf' => $data['cpf'],
            'identidade' => $data['identidade'],
            'telefone' => $data['telefone'],
            'telefonecel' => $data['telefonecel'],
            'creci' => $data['creci'],
            'datanascimento' => $data['datanascimento'],
            'dataadmissao' => $data['dataadmissao'],
            'datademissao' => !empty($data['datademissao']) ? $data['datademissao'] : null,
            'observacoes' => $data['observacoes'],
        ]);

        return $response->withRedirect($this->router->pathFor('usuario.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {
        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        $user = Usuario::with(['foto', 'grupo'])->find((int) $request->getAttribute('id'));

        if (!$this->validator->Valid() || empty($user)) {
            return $response->withRedirect($this->router->pathFor('usuario.indexview'));
        }

        if (!isset($_SESSION['unsaveddata'])) {
            $_SESSION['old'] = [
                'nome' => $user->nome,
                'email' => $user->email,
                'login' => $user->login,
                'id' => $user->id,
                'urlrelative' => $user->foto && $user->foto->exists ? $user->foto->urlrelative : null,
                'foto_id' => $user->foto->exists ? $user->foto->id : null,
                'grupo' => $user->grupo_id,
                'cpf' => $user->cpf,
                'identidade' => $user->identidade,
                'telefone' => $user->telefone,
                'telefonecel' => $user->telefonecel,
                'creci' => $user->creci,
                'datanascimento' => $user->datanascimento,
                'dataadmissao' => $user->dataadmissao,
                'datademissao' => $user->datademissao,
                'observacoes' => $user->observacoes,
            ];
        } else {
            $_SESSION['old'] = $_SESSION['unsaveddata'];
            unset($_SESSION['unsaveddata']);           
        }

        $grupos = Grupo::all();

        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'usuario/create.twig', ['DescricaoLabelBotaoUploadImagem' => 'Carregar foto', 'grupos' => $grupos]);
    }

    public function _update($request, $response, $data, $user)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email(),
            'nome' => v::notEmpty(),
            'identidade' => v::noWhitespace()->notEmpty(),
            'cpf' => v::noWhitespace()->notEmpty(),
            'datanascimento' => v::optional(v::date())->optional(v::length(8,8)),
            'dataadmissao' => v::optional(v::date())->optional(v::length(8,8)),
            'datademissao' => v::optional(v::date())->optional(v::length(8,8)),
        ]);

        if (!$this->validator->Valid()) {
            $this->SetUnsavedData($data);           
            return $response->withRedirect($this->router->pathFor('usuario.editview', ["id" => $user->id]));
        }

        $user->email = $data['email'];
        $user->nome = $data['nome'];
        $fotoChanged = false;
        $oldFotoID = 0;
        $newFotoUploaded = !empty($data['foto_id']);
        if ($newFotoUploaded) {
            $fotoChanged = $user->foto_id != $data['foto_id'];
            $oldFotoID = $user->foto_id;
            $user->foto_id = $data['foto_id'];
        }

        $user->grupo_id = $data['grupo'];
        $user->cpf = $data['cpf'];
        $user->identidade = $data['identidade'];
        $user->telefone = $data['telefone'];
        $user->telefonecel = $data['telefonecel'];
        $user->creci = $data['creci'];
        $user->datanascimento = $data['datanascimento'];
        $user->dataadmissao = !empty($data['dataadmissao']) ? $data['dataadmissao'] : null;
        $user->datademissao = !empty($data['datademissao']) ? $data['datademissao'] : null;
        $user->observacoes = $data['observacoes'];
       
        $user->save();

        if ($fotoChanged) {
            $this->FotoController->_DeleteImage($oldFotoID);
        }

        return $response->withRedirect($this->router->pathFor('usuario.indexview'));
    }

    public function Delete($request, $response)
    {
    }

    public function ActivateDeactivate($request, $response)
    {
        $user = Usuario::find((int) $request->getAttribute('id'));
        $user->ativo = $user->ativo ? 0 : 1;
        $user->save();
        $response = $response->withStatus(200);
        return $response;
    }

    public function _find($id)
    {
        return Usuario::find($id);
    }

    public function GetCurrentFoto()
    {
        $currentUserFoto = Usuario::with('foto')->find($_SESSION['user']['id']);
        if ($currentUserFoto->foto->exists) {
            return $currentUserFoto->foto->urlrelative;
        }
        return "";
    }
}

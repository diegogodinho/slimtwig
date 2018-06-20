<?php

namespace App\Controllers;

use App\Domain\Bairro;
use App\Domain\Cidade;
use App\Domain\Estado;
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
        $estado = Estado::all();
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

        return $this->view->render($response, 'usuario/create.twig', ['DescricaoLabelBotaoUploadImagem' => 'Carregar foto',
            'grupos' => $grupos,
            'estados' => $estado,
            'cidades' => $cidades,
            'bairros' => $bairros,
        ]);
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
            'datanascimento' => v::optional(v::date())->optional(v::length(8, 8)),
            'dataadmissao' => v::optional(v::date())->optional(v::length(8, 8)),
            'datademissao' => v::optional(v::date())->optional(v::length(8, 8)),
        ]);

        if (!$this->validator->Valid()) {
            $this->SetUnsavedData($data);
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
            'datanascimento' => $data['datanascimento'] != null ? $data['datanascimento'] : null,
            'dataadmissao' => $data['dataadmissao'] != null ? $data['dataadmissao'] : null,
            'datademissao' => $data['datademissao'] != null ? $data['datademissao'] : null,
            'observacoes' => $data['observacoes'],
            'bairro_id' => $data['bairro'],
            'endereco' => $data['endereco'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'ativo' => in_array("grupo", $data) ? is_numeric($data['grupo']) && (int($data['grupo'])) > 0 ? 1 : 0 : 0,
        ]);

        return $response->withRedirect($this->router->pathFor('usuario.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {
        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        $user = Usuario::with(['foto', 'grupo', 'bairro.cidade.estado'])->find((int) $request->getAttribute('id'));

        if (!$this->validator->Valid() || empty($user)) {
            return $response->withRedirect($this->router->pathFor('usuario.indexview'));
        }

        $grupos = Grupo::all();
        $estado = Estado::all();
        $cidades = [];
        $bairros = [];
        $existeBairro = $user->bairro && $user->bairro->exists;

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
                'bairro' => $existeBairro ? $user->bairro->id : null,
                'cidade' => $existeBairro ? $user->bairro->cidade->id : null,
                'estado' => $existeBairro ? $user->bairro->cidade->estado_id : null,
                'endereco' => $user->endereco,
                'numero' => $user->numero,
                'complemento' => $user->complemento,
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

        return $this->view->render($response, 'usuario/create.twig', ['DescricaoLabelBotaoUploadImagem' => 'Carregar foto',
            'grupos' => $grupos,
            'estados' => $estado,
            'cidades' => $cidades,
            'bairros' => $bairros]);
    }

    public function _update($request, $response, $data, $user)
    {
        $validation = $this->validator->Validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email(),
            'nome' => v::notEmpty(),
            'identidade' => v::noWhitespace()->notEmpty(),
            'cpf' => v::noWhitespace()->notEmpty(),
            'datanascimento' => v::optional(v::date())->optional(v::length(8, 8)),
            'dataadmissao' => v::optional(v::date())->optional(v::length(8, 8)),
            'datademissao' => v::optional(v::date())->optional(v::length(8, 8)),
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
        $user->datanascimento = $data['datanascimento'] != null ? $data['datanascimento'] : null;
        $user->dataadmissao = $data['dataadmissao'] != null ? $data['dataadmissao'] : null;
        $user->datademissao = $data['datademissao'] != null ? $data['datademissao'] : null;
        $user->observacoes = $data['observacoes'];
        $user->bairro_id = $data['bairro'];
        $user->endereco = $data['endereco'];
        $user->numero = $data['numero'];
        $user->complemento = $data['complemento'];
        $user->ativo = in_array("grupo", $data) ? is_numeric($data['grupo']) && (int($data['grupo'])) > 0 ? 1 : 0 : 0;

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
        if (is_numeric($user->grupo_id) && (int($user->grupo_id)) > 0) {
            $user->ativo = $user->ativo ? 0 : 1;
            $user->save();
            return $response->withStatus(200);
        }
        else
        {
            return $response->withStatus(406)->withJson(['mensagem'=> "Nao e possivel ativar usuario sem grupo ou sem permissoes especificas. Contate o Administrador do Sistema."]);
        }        
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

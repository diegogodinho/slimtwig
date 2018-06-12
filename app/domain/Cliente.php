<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = ["nome", "email", "cpf", "cnpj", "tipopessoa", "identidade", "sexo", "datanascimento", "telefone", "telefonecel",
        "ativo", "estadocivil", "idusuariocriacao", "idendereco", "observacao"];

}

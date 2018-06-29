<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Proprietario extends Model
{
    protected $table = 'proprietario';

    protected $fillable = ["nome", "email", "identidade", "telefone", "telefonecel", "telefoneadicional", "foto_id", "bairro_id", "endereco",
        "cep", "numero", "complemento", "datanascimento", "profissao", "estadocivil", "nacionalidade", "facebook", "skype", "linkedin", "observacoes", "usuario_id"];

    public function foto()
    {
        return $this->hasOne('App\Domain\Foto', 'id', 'foto_id')->withDefault();
    }

    public function usuario()
    {
        return $this->hasOne('App\Domain\Usuario', 'id', 'usuario_id')->withDefault();
    }
}

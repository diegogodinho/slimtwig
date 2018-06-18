<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $fillable = ["nome", "email", "login", "senha", "ativo", "foto_id", "cpf", "identidade", "grupo_id", "tipousuario", "datanascimento",
        "creci", "dataadmissao", "datademissao", "telefone", "telefonecel", "observacoes"];

    public function foto()
    {
        return $this->hasOne('App\Domain\Foto', 'id', 'foto_id')->withDefault();
    }

    public function grupo()
    {
        return $this->hasOne('App\Domain\Grupo','id','grupo_id');
    }
}

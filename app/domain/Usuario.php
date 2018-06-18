<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $fillable = ["nome", "email", "login", "senha", "ativo","foto_id"];


    public function foto()
    {
        return $this->hasOne('App\Domain\Foto','id','foto_id')->withDefault();
    }

    public function grupo()
    {
        return $this->belongsTo('App\Domain\Grupo');
    }
}

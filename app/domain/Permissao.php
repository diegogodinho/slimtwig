<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissao';

    protected $fillable = ["grupo_id", "usuario_id", "acaofuncionalidade_id"];

    public $timestamps = false;    

    public function acaofuncionalidade()
    {
        return $this->belongsTo('App\Domain\AcaoFuncionalidade');
    }
}

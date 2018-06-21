<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class AcaoFuncionalidade extends Model
{
    protected $table = 'acaofuncionalidade';

    protected $fillable = ["nome", "url", "metodo", "funcionalidade_id"];

    public $timestamps = false;

    public function funcionalidade()
    {
        return $this->belongsTo('App\Domain\Funcionalidade');
    }

}

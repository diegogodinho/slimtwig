<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regiao';

    protected $fillable = ["nome","ativo"];

    public function bairros()
    {
        return $this->belongsToMany('App\Domain\Bairro', 'bairro_regiao', 'regiao_id','bairro_id');
    }
}

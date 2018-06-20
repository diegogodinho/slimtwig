<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class TipoImovel extends Model
{
    protected $table = 'tipoimovel';

    protected $fillable = ["nome", "ativo"];
    
    public $timestamps = false;	
}



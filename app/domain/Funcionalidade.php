<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Funcionalidade extends Model
{
    protected $table = 'funcionalidade';

    protected $fillable = ["nome", "pai_id", "acessar"];

    public $timestamps = false;

}
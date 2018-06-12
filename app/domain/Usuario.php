<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $fillable = ["nome", "email", "login", "senha", "ativo"];

}

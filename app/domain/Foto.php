<?php

namespace Domain;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    
    protected $fillable = ["name"];
    
}

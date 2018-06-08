<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';

    protected $fillable = ["name", "physicaldirectory", "urlrelative", "iswaterMark"];

    public $timestamps = false;

}

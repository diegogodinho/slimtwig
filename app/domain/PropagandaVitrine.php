<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class PropagandaVitrine extends Model
{
    protected $table = 'propagandavitrine';

    protected $fillable = ["nome", "urlfoto1", "urlfoto2"];

    public $timestamps = false;
}

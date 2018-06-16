<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {

	protected $table = 'estado';

    protected $fillable = ["nome","sigla"];
    
    public $timestamps = false;	
}
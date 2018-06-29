<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Midia extends Model {

	protected $table = 'midia';

    protected $fillable = ["nome", "ativo"];
    
    public $timestamps = false;	
}
<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class ItemImovel extends Model {

	protected $table = 'itemimovel';

    protected $fillable = ["nome", "ativo","possuiqtde"];
    
    public $timestamps = false;	
}
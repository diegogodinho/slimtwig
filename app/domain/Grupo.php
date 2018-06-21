<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

	protected $table = 'grupo';

    protected $fillable = ["nome"];
    
    public $timestamps = false;
        
    public function permissao()
    {
        return $this->hasMany('App\Domain\Permissao');
    }
}
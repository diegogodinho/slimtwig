<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model {

	protected $table = 'bairro';

    protected $fillable = ["nome",'cidade_id'];
    
    public $timestamps = false;	

    public function cidade()
    {
        return $this->belongsTo('App\Domain\Cidade');
    }
}
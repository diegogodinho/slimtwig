<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {

	protected $table = 'cidade';

    protected $fillable = ["nome",'estado_id'];
    
    public $timestamps = false;	

    public function estado()
    {
            return $this->belongsTo('App\Domain\Estado');
    }
}
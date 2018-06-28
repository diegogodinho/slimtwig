<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Construtora extends Model
{
    protected $table = 'construtora';
    
    public $timestamps = false;	

    protected $fillable = ["nome", "bairro_id", "endereco", "complemento",'telefone','telefonecel','observacoes'];

    public function bairro()
    {
        return $this->hasOne('App\Domain\Bairro', 'id', 'bairro_id')->withDefault();
    }    
}

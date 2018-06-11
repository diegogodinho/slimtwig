<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = 'tag';

    protected $fillable = ["name", "active"];
    
    public $timestamps = false;	
}
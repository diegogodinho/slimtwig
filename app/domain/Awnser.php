<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Awnser extends Model 
{
    protected $table = 'awnser';
    
    protected $fillable = ["description","right_awnser"];

    public function question()
    {
        return $this->belongsTo('Api\Domain\Question');
    }
}
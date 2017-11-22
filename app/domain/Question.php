<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{
    protected $table = 'question';
    
    protected $fillable = ["description", "user_id", "short_description","difficulty", "enable", "DescriptionRigthAwnser"];


    public function awnser()
    {
        return $this->hasMany('App\Domain\Awnser');
    }

    public function user()
    {
        return $this->hasOne('App\Domain\User');
    }
}
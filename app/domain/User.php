<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = ["name", "email", "login", "password", "active"];

}

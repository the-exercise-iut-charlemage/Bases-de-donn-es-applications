<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'name', 'surname', 'adress', 'phone', 'birth'];
    public $timestamps = false;

    
}
<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'platform';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
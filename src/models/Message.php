<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content'];
    public $timestamps = true;

    public function user() {
        return $this->belongsToMany('\appdb\models\User', 'message2user', 'idmsg', 'idusr');
    }
}
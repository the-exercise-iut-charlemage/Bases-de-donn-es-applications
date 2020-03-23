<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

    protected $table = 'genre';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name', 'deck', 'description'];
    public $timestamps = false;

    public function games() {
        return $this->belongsToMany('\appdb\models\Game', 'game2genre', 'genre_id', 'game_id');
    }
}
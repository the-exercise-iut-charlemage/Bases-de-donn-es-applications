<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class Character extends Model {

    protected $table = 'character';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name', 'real_name', 'last_name','alias',
        'deck', 'description',
        'birthday', 'gender', 'first_appeared_in_game_id'
    ];

//    public function first_appeared_in_game() {
//
//        return $this->belongsTo('\appdb\models\Game', 'first_appeared_in_game_id');
//    }

    public function games() {
        return $this->belongsToMany('\appdb\models\Game', 'game2character', 'character_id', 'game_id');
    }

//    public function friends() {
//        return $this->belongsToMany('\appdb\models\Character', 'friends', 'char1_id', 'char2_id');
//    }
//
//    public function enemies() {
//        return $this->belongsToMany('\appdb\models\Character', 'enemies', 'char1_id', 'char2_id');
//    }
}
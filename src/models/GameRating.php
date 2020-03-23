<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class GameRating extends Model {

    protected $table = 'game_rating';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name', 'rating_board_id'];
    public $timestamps = false ;


    public function games() {
        return $this->belongsToMany('\appdb\models\Game', 'game2rating', 'rating_id', 'game_id');
    }

    public function rating_board() {
        return $this->belongsTo('\appdb\models\RatingBoard', 'rating_board_id');
    }
}
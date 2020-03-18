<?php


namespace appdb\models;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name', 'alias', 'deck', 'description',
        'abbreviation', 'date_founded', 'location_address', 'location_city',
        'location_country', 'location_state', 'phone', 'website'];

    public function gameDevelops() {
        return $this->belongsToMany('\appdb\models\Game', 'game_developers', 'comp_id', 'game_id');
    }

    public function gamePublish() {
        return $this->belongsToMany('\appdb\models\Game', 'game_publishers', 'comp_id', 'game_id');
    }
}
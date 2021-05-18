<?php

namespace App\Models\Player;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Player
 * @package App\Models
 * @property int $id
 * @property int $player_id
 * @property int $level
 * @property int $exp
 * @property int $points
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Level extends Model
{
    const START_LEVEL = 1;
    const START_EXP = 100;
    const START_POINTS = 100;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'player_levels';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
      protected $hidden = [
          'created_at',
          'updated_at'
      ];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

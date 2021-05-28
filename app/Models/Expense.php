<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Expense
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property string $repeat_at
 * @property float $sum
 */
class Expense extends Model
{
    use CrudTrait, HasFactory;

    const REPEAT_AT_DAY = 'day';
    const REPEAT_AT_WEEK = 'week';
    const REPEAT_AT_MONTH = 'month';
    const NOT_REPEAT = 'not';

    protected $table = 'expenses';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function getExpensesRepeatTypeList()
    {
        return [
            self::REPEAT_AT_DAY => 'Каждый день',
            self::REPEAT_AT_WEEK => 'Каждую неделю',
            self::REPEAT_AT_MONTH => 'Каждый месяц',
            self::NOT_REPEAT => 'Нет повторов',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'expense_tag');
    }

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

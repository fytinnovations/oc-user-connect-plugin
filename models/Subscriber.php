<?php namespace Fytinnovations\UserConnect\Models;

use Model;
use Illuminate\Support\Str;
/**
 * Subscribers Model
 */
class Subscriber extends Model
{
    use \October\Rain\Database\Traits\Validation;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_userconnect_subscribers';

    public $rules = [
        'email'    => 'required|between:6,255|email',
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['email','verification_key','is_verified'];

    protected $dates = ['verified_at'];
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * Scope a query to only include verified subscribers.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', 1);
    }
}

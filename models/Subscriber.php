<?php

namespace Fytinnovations\UserConnect\Models;

use Fytinnovations\Userconnect\Models\Subscription;
use Model;
use Mail;

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
        'email'    => 'required|between:6,255|email|unique:fytinnovations_userconnect_subscribers',
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['email',];

    protected $dates = [];
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'subscriptions' => Subscription::class
    ];
    public $belongsTo = [
        'category' => Subscriber::class
    ];
    public $belongsToMany = [
        'categories' => [Subscriber::class, 'table' => 'fytinnovations_userconnect_subscriptions', 'timestamps' => true]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}

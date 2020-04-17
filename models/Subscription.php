<?php

namespace Fytinnovations\Userconnect\Models;

use Fytinnovations\UserConnect\Models\Subscriber;
use Model;
use Mail;

/**
 * Subscription Model
 */
class Subscription extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_userconnect_subscriptions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['subscriber_id', 'category_id'];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'subscriber' => Subscriber::class,
        'category' => Category::class
    ];
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
    public function scopeUnVerified($query)
    {
        return $query->where('is_verified', 0);
    }

    /**
     * {@inheritDoc}
     *
     */
    public function beforeCreate()
    {
        $settings = Settings::instance();

        $isVerificationEnabled = $settings->verify_emails;

        if ($isVerificationEnabled) {
            $keyExpiresAfter = $settings->key_expires_in;

            $this->verification_key = static::generateVerificationKey();
            $this->valid_till = date('Y-m-d H:i:s', strtotime('+' . $keyExpiresAfter . ' day', time()));
        }
    }

    /**
     * {@inheritDoc}
     *
     */
    public function afterCreate()
    {
        $isVerificationEnabled = Settings::get('verify_emails');

        if ($isVerificationEnabled) {

            $vars = [
                'link' => url('/email_verification/' . $this->subscriber->email . '/' . $this->verification_key),
                "app_name" => config('app.name')
            ];

            Mail::send('fytinnovations.userconnect::mail.verify_subscriber', $vars, function ($message) {
                $message->to($this->subscriber->email);
            });
        }
    }

    /**
     * Generates a unique uuid for verification of the subscriber
     *
     * @return string
     */
    protected static function generateVerificationKey()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    /**
     * Verifies the subscription of the user using the key.
     *
     * @param string $verification_key
     * @return bool
     */
    public function verify(string $verification_key): bool
    {
        if ($this->valid_till > date('Y-m-d:H:i:s') && $this->verification_key == $verification_key) {

            $this->verified_at = now();
            $this->is_verified = true;

            $this->save();

            return true;
        }

        return false;
    }
}

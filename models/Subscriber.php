<?php

namespace Fytinnovations\UserConnect\Models;

use Model;
use Event;
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
        'verification_key' => 'nullable|unique:fytinnovations_userconnect_subscribers',
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['email', 'verification_key', 'is_verified'];

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

    public $bodyClass = 'compact-container';

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
    public function scopeWeeklySubscribers($query)
    {
        $start_date = date("Y-m-d", strtotime("-1 week +1 day"));
        return $query->where('created_at', '>', $start_date)->groupBy(DB::raw('date(created_at)'))->count();
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
                'link' => url('/email_verification/' . $this->email . '/' . $this->verification_key),
                "app_name" => config('app.name')
            ];

            Mail::send('fytinnovations.userconnect::mail.verify_subscriber', $vars, function ($message) {
                $message->to($this->email);
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
}

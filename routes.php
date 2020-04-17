<?php

use Cms\Classes\Controller;
use Fytinnovations\UserConnect\Models\{Subscription, Settings, Subscriber};

Route::get('/email_verification/{email}/{verification_key}', function ($email, $verification_key) {

    try {
        $subscriptions = Subscriber::where('email', $email)->first()->subscriptions;
    } catch (\Throwable $th) {
        return app(Controller::class)->run('/404');
    }

    $subscriptions->each(function ($subscription) use ($verification_key) {
        $subscription->verify($verification_key);
    });

    $verifiedSubscriptions = $subscriptions->filter(function ($subscription) {
        return $subscription->is_verified;
    });

    if ($verifiedSubscriptions) {

        $verificationSuccessPage = Settings::get('verification_success_page');

        Flash::success(Lang::get('fytinnovations.userconnect::lang.mail.user_verified_successfully'));

        return app(Controller::class)->run($verificationSuccessPage);
    }

    return app(Controller::class)->run('/404');
});

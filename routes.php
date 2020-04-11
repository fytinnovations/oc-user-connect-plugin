<?php

use Cms\Classes\Controller;
use Fytinnovations\UserConnect\Models\Settings;
use Fytinnovations\UserConnect\Models\Subscriber;

Route::get('/email_verification/{email}/{verification_key}', function ($email, $verification_key) {

    $isVerified = Subscriber::where('email', $email)->first()->verify($verification_key);

    if ($isVerified) {

        $verificationSuccessPage = Settings::get('verification_success_page');

        Flash::success(Lang::get('fytinnovations.userconnect::lang.mail.user_verified_successfully'));

        return app(Controller::class)->run($verificationSuccessPage);
    }

    return app(Controller::class)->run('/404');
});

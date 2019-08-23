<?php
use Fytinnovations\UserConnect\Classes\NewsletterManager;
    Route::get('/email_verification/{email}/{verification_key}', function ($email,$verification_key) {
        if(NewsletterManager::verifyEmail($email,$verification_key)){
            return "Email Verified Successfully";
        }else{
            App::abort(404);
        }
    });  
?>
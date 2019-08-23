<?php
use Fytinnovations\UserConnect\Classes\NewsletterManager;
    Route::get('/email_verification/{email}/{verification_key}', function ($email,$verification_key) {
        $result=NewsletterManager::verifyEmail($email,$verification_key);
        if($result["status"]){
            return $result["message"];
        }else{
            App::abort(404);
        }
    });  
?>
<?php namespace Fytinnovations\UserConnect\Classes;

use Input;
use Fytinnovations\UserConnect\Models\Settings;
use Fytinnovations\UserConnect\Models\Subscriber;
use Mail;
use Event;

class NewsletterManager 
{
    public static function subscribe(){
        $subscriber=Subscriber::firstOrNew(['email' =>Input::get('email')]);
        $subscriber->verification_key= static::genUUID();
        $valid_till=date('Y-m-d H:i:s', strtotime('+'.Settings::instance()->key_expires_in.' day', time()));
        $subscriber->valid_till=$valid_till;
        if($subscriber->save()){
            static::sendEmailIfEnabled($subscriber);
            return true;
        }
        return false;
    }

    public static function genUUID() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    public static function verifyEmail($email,$verification_key){
        $response=[
            "status"=>true,
            "message"=>""
        ];
        $subscriber=Subscriber::where('email',$email)->first();

        //If already verified no need to verify again
        if($subscriber->is_verified){
            $response=[
                "status"=>true,
                "message"=>"You have been already assigned to the subscribers list"
            ];
            
        }else{
            $cur_date_time=date('Y-m-d H:i:s');
            if(count($subscriber)>0 && $subscriber->verification_key==$verification_key && $subscriber->valid_till>$cur_date_time){
                $subscriber->is_verified=true;
                $subscriber->verified_at=$cur_date_time;
                $subscriber->save();
                $response=[
                    "status"=>true,
                    "message"=>"Congratulations, You have been added to the subscribers list"
                ];
            }else{
                $response=[
                    "status"=>false,
                    "message"=>"Verification Failed! Please try again!"
                ];
            }
            
        }
        return $response;
    }

    /**
     * Send a Email for verification if Enabled Inside of UserConnect Settings
     */
    public static function sendEmailIfEnabled($subscriber){
        $vars = [
            'link' => url('/email_verification/'.$subscriber->email.'/'.$subscriber->verification_key),
            "app_name"=>config('app.name')
        ];
        if(Settings::get('verify_emails',false)){
            Event::fire('fytinnovations.userconnect.beforeVerificationMailSend', [$subscriber]);
            Mail::send('fytinnovations.userconnect::mail.subscriber_verification', $vars, function($message) use ($subscriber){
                $message->to($subscriber->email, 'New Subscriber');
                $message->subject('Newletter Subscription Verification');
            });
            return true;
        }
        return false;
    }
}

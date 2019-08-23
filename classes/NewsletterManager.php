<?php namespace Fytinnovations\UserConnect\Classes;

use Input;
use Fytinnovations\UserConnect\Models\Settings;
use Fytinnovations\UserConnect\Models\Subscriber;
class NewsletterManager 
{
    public static function subscribe(){
        $subscriber=Subscriber::firstOrNew(['email' =>Input::get('email')]);
        $subscriber->verification_key= static::genUUID();
        $valid_till=date('Y-m-d H:i:s', strtotime('+'.Settings::instance()->key_expires_in.' day', time()));
        $subscriber->valid_till=$valid_till;
        if($subscriber->save()){
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
        }

        $cur_date_time=date('Y-m-d H:i:s');
        if(count($subscriber)>0 && $subscriber->verification_key==$verification_key && $subscriber->valid_till>$cur_date_time){
            $subscriber->is_verified=true;
            $subscriber->verified_at=$cur_date_time;
            $subscriber->save();
            $response=[
                "status"=>true,
                "message"=>"Congratulations, You have been added to the subscribers list"
            ];
        }
        $response=[
            "status"=>false,
            "message"=>"Verification Failed! Please try again!"
        ];

        return $response;
    }
}

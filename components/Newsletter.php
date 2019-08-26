<?php namespace Fytinnovations\UserConnect\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\UserConnect\Classes\NewsletterManager;
use Fytinnovations\UserConnect\Models\Settings;
use Fytinnovations\UserConnect\Models\Subscriber;


class Newsletter extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Newsletter Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){
        if(Settings::get('newsletter_styles',true)){
            $this->addCss('/plugins/fytinnovations/userconnect/assets/css/newsletter.css');
        }
        $this->page['primary_color']=Settings::get('newsletter_primary_color', "#ff4500")??"#ff4500";
        $this->page['secondary_color']=Settings::get('newsletter_secondary_color', "#ffffff")??"#ffffff";
    }
    public function onSubscribe(){
        $this->page['subscribe_success']=NewsletterManager::subscribe();
        $this->page['newsletter_success_message']=Settings::get('newsletter_success_message', "Thankyou for subscribing.");
    }

}

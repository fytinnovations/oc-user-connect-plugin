<?php namespace Fytinnovations\UserConnect\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\UserConnect\Models\Settings;

class SocialFabs extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'SocialFabs Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){
        $this->addCss('assets/css/all.min.css');
        if(Settings::get('fab_styles',true)){
            $this->addCss('assets/css/socialfab.css');
        }
        $this->page['fab_primary_color']=Settings::get('social_fab_primary_color', "#2c4")??"#2c4";
        $this->page['fab_contact_number']=Settings::get('contact_number', "918850505322")??"918850505322";
        $this->page['fab_fb_page_name']=Settings::get('fb_page_name', "fytinnovationsofficial")??"fytinnovationsofficial";
        $this->page['fab_email']=Settings::get('business_email', "support@fytinnovations.com")??"support@fytinnovations.com";
        $this->page['fab_position']=Settings::get('fab_position', "right")??"right";
    }
}
